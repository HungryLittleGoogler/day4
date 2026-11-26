<?php

use App\Http\Controllers\ReportCardController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/sections');
});

Route::get('/sections', [SectionController::class, 'index']);
Route::get('/sections/{section}', [SectionController::class, 'show']);
Route::get('/students/{student}', [ReportCardController::class, 'show']);
