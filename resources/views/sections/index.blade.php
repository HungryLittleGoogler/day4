@extends('layouts.app')

@section('title', 'Sections')

@section('content')
    <h1>Sections</h1>
    <table>
        <tr><th>Section</th><th>Grade</th><th>Adviser</th><th>Students</th></tr>
        @foreach ($sections as $section)
            <tr>
                <td><a href="/sections/{{ $section->id }}">{{ $section->name }}</a></td>
                <td>{{ $section->grade_level }}</td>
                <td>{{ $section->adviser?->fullName() ?? 'No adviser' }}</td>
                <td>{{ $section->students_count }}</td>
            </tr>
        @endforeach
    </table>
@endsection
