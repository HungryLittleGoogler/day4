<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\ReportCardService;

class ReportCardController extends Controller
{
    public function show(Student $student, ReportCardService $cards)
    {
        $card = $cards->card($student);

        return view('students.report-card', [
            'student' => $student,
            'rows' => $card['rows'],
            'average' => $card['average'],
            'remark' => $card['remark'],
        ]);
    }
}
