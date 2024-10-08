<?php

use App\Http\Controllers\student\AssignmentController;
use App\Http\Controllers\student\EnrollController;
use App\Http\Controllers\student\TestController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('student')->controller(EnrollController::class)->group(function () {
    Route::get("/courses", "index")->name("student.courses.index");
    Route::get("/enroll/{id}", "enroll")->name("student.courses.Enroll");
    Route::post('/payment','payment')->name("student.courses.payment");
});

Route::middleware('auth')->prefix('student')->controller(AssignmentController::class)->group(function () {
    Route::post('assignment',[AssignmentController::class,'create'])->name("student.assignments.create");
    Route::delete("assignment/{id}", "delete")->name("student.assignments.delete");
});
Route::middleware('auth')->prefix('student')->controller(TestController::class)->group(function () {
    Route::get('{courseId}/{lessonId}/test/{id}', "index")->name("student.test.index");
    Route::post('{courseId}/{lessonId}/answerTest/{id}','submitAnswer')->name("student.test.answer");
    Route::get('/showAnswer/{id}','showAnswer')->name('student.test.showAnswer');
});
