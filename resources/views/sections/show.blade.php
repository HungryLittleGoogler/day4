@extends('layouts.app')

@section('title', $section->name)

@section('content')
    <h1>Grade {{ $section->grade_level }} · {{ $section->name }}</h1>
    <table>
        <tr><th>LRN</th><th>Name</th><th>General average</th><th>Remark</th></tr>
        @foreach ($summaries as $row)
            <tr>
                <td>{{ $row['student']->lrn }}</td>
                <td><a href="/students/{{ $row['student']->id }}">{{ $row['student']->fullName() }}</a></td>
                <td>{{ $row['average'] ?? '-' }}</td>
                <td class="{{ strtolower(str_replace(' ', '-', $row['remark'])) }}">{{ $row['remark'] }}</td>
            </tr>
        @endforeach
    </table>
@endsection
