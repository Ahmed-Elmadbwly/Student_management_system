<?php

use App\Http\Controllers\student\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('teacher')->controller(AssignmentController::class)->group(function () {
    Route::get('/answers/{id}','answers')->name("teacher.assignments.answers");
    Route::get('{answerId}/review/{id}','review')->name("teacher.assignments.review");
    Route::post('{answerId}/review/{id}','addScore')->name("teacher.assignments.score");
    Route::get('/allAssignment','allAssignment')->name("teacher.assignments.allAssignment");
});
