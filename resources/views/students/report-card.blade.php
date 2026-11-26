@extends('layouts.app')

@section('title', $student->fullName())

@section('content')
    <h1>{{ $student->fullName() }}</h1>
    <p>
        LRN {{ $student->lrn }} ·
        Grade {{ $student->section->grade_level }} {{ $student->section->name }} ·
        Adviser: {{ $student->section->adviser?->fullName() ?? 'none' }}
    </p>

    @if ($rows->isEmpty())
        <p class="no-grades">No grades recorded yet.</p>
    @else
        <table>
            <tr><th>Subject</th><th>Sem 1</th><th>Sem 2</th><th>Final</th></tr>
            @foreach ($rows as $row)
                <tr>
                    <td>{{ $row['subject']->name }}</td>
                    <td>{{ $row['sem1'] ?? 'INC' }}</td>
                    <td>{{ $row['sem2'] ?? 'INC' }}</td>
                    <td>{{ $row['final'] ?? '-' }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <p class="summary">
        General average: <b>{{ $average ?? '-' }}</b>
        · Remark: <b>{{ $remark }}</b>
    </p>
    <p><a href="/sections/{{ $student->section_id }}">← Back to {{ $student->section->name }}</a></p>
@endsection
