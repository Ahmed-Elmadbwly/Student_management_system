<?php

use App\Http\Controllers\admin\ScoreBoardController;
use App\Http\Controllers\student\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('teacher')->controller(AssignmentController::class)->group(function () {
    Route::get('/answers/{id}','answers')->name("teacher.assignments.answers");
    Route::get('{answerId}/review/{id}','review')->name("teacher.assignments.review");
    Route::post('{answerId}/review/{id}','addScore')->name("teacher.assignments.score");
    Route::get('/allAssignment','allAssignment')->name("teacher.assignments.allAssignment");
});
Route::middleware('auth')->prefix('teacher')->controller(ScoreBoardController::class)->group(function () {
    Route::get('/tests','index')->name("teacher.tests.index");
    Route::get('/scoreboard/{id}','scoreStudent')->name("teacher.scoreboard");
    Route::get('/assignment','showAssignment')->name("teacher.assignment.index");
    Route::get('/assignmentScore/{id}','assignmentScore')->name("teacher.scoreboard.assignment");
});

