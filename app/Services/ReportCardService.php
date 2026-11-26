<?php

namespace App\Services;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Collection;

// The kitchen: the school's grading rules live here, in one place.
class ReportCardService
{
    public const PASSING = 75;

    // Everything one report card needs. The kitchen asks the pantry (the models)
    // for the ingredients, loading them in as few queries as possible.
    public function card(Student $student): array
    {
        $student->loadMissing(['section.adviser', 'grades.subject']);

        return [
            'rows' => $this->rows($student),
            'average' => $this->generalAverage($student),
            'remark' => $this->remark($student),
        ];
    }

    // The class list of one section: each student with their average and remark.
    public function classList(Section $section): Collection
    {
        $students = $section->students()->with('grades')->orderBy('last_name')->get();

        return $students->map(fn (Student $student) => [
            'student' => $student,
            'average' => $this->generalAverage($student),
            'remark' => $this->remark($student),
        ]);
    }

    // Plain average of every grade that is not NULL.
    public function generalAverage(Student $student): ?float
    {
        $average = $student->grades->whereNotNull('grade')->avg('grade');

        return $average === null ? null : round($average, 2);
    }

    public function remark(Student $student): string
    {
        if ($student->grades->isEmpty()) {
            return 'NO GRADES';
        }
        if ($student->grades->whereNull('grade')->isNotEmpty()) {
            return 'INC';
        }

        return $this->generalAverage($student) >= self::PASSING ? 'PASSED' : 'FAILED';
    }

    // One row per subject, with semester 1 and semester 2 side by side.
    public function rows(Student $student): Collection
    {
        return $student->grades->groupBy('subject_id')->map(function ($grades) {
            $sem1 = $grades->firstWhere('semester', 1)?->grade;
            $sem2 = $grades->firstWhere('semester', 2)?->grade;

            return [
                'subject' => $grades->first()->subject,
                'sem1' => $sem1,
                'sem2' => $sem2,
                'final' => ($sem1 !== null && $sem2 !== null) ? round(($sem1 + $sem2) / 2, 2) : null,
            ];
        });
    }
}
