<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Services\ReportCardService;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('adviser')->withCount('students')->orderBy('name')->get();

        return view('sections.index', ['sections' => $sections]);
    }

    public function show(Section $section, ReportCardService $cards)
    {
        return view('sections.show', [
            'section' => $section,
            'summaries' => $cards->classList($section),
        ]);
    }
}
