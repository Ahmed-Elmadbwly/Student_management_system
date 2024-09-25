<?php

use App\Http\Controllers\admin\categoryController;
use App\Http\Controllers\admin\classController;
use App\Http\Controllers\admin\coursesController;
use App\Http\Controllers\admin\LessonController;
use App\Http\Controllers\admin\studentController;
use App\Http\Controllers\admin\SubLessonController;
use App\Http\Controllers\chatController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->controller(categoryController::class)->group(function () {
    Route::get("/category", "index")->name("category.index");
    Route::get("/category/create", "create")->name("category.create");
    Route::post("/category", "store")->name("category.store");
    Route::get("/category/{id}/edit", "edit")->name("category.edit");
    Route::post("/category/{id}", "update")->name("category.update");
    Route::delete("/category/{id}", "delete")->name("category.delete");
});

Route::middleware('auth')->prefix('admin')->controller(classController::class)->group(function () {
    Route::get("/classes", "index")->name("classes.index");
    Route::get("/classes/create", "create")->name("classes.create");
    Route::post("/classes", "store")->name("classes.store");
    Route::get("/classes/{id}/edit", "edit")->name("classes.edit");
    Route::post("/classes/{id}", "update")->name("classes.update");
    Route::delete("/classes/{id}", "delete")->name("classes.delete");
});

Route::middleware('auth')->prefix('admin')->controller(coursesController::class)->group(function () {
    Route::get("/courses", "index")->name("courses.index");
    Route::get("/course/create", "create")->name("course.create");
    Route::post("/course", "store")->name("course.store");
    Route::get("/course/{id}/edit", "edit")->name("course.edit");
    Route::post("/course/{id}", "update")->name("course.update");
    Route::delete("/course/{id}", "delete")->name("course.delete");
});

Route::middleware('auth')->prefix('admin')->controller(LessonController::class)->group(function () {
    Route::get("/{courseId}/lessons", "index")->name("lessons.index");
    Route::get("/{courseId}/lesson/create", "create")->name("lesson.create");
    Route::post("/{courseId}/lesson", "store")->name("lesson.store");
    Route::get("/{courseId}/lesson/{id}/edit", "edit")->name("lesson.edit");
    Route::post("/{courseId}/lesson/{id}", "update")->name("lesson.update");
    Route::delete("/{courseId}/lesson/{id}", "delete")->name("lesson.delete");
});

Route::middleware('auth')->prefix('admin')->controller(SubLessonController::class)->group(function () {
    Route::get("/{courseId}/{lessonId}/subLessons", "index")->name("subLessons.index");
    Route::get("/{courseId}/{lessonId}/subLesson/create", "create")->name("subLesson.create");
    Route::post("/{courseId}/{lessonId}/subLesson", "store")->name("subLesson.store");
    Route::get("/{courseId}/{lessonId}/subLesson/{id}/edit", "edit")->name("subLesson.edit");
    Route::get("/{courseId}/{lessonId}/subLesson/{id}/show", "show")->name("subLesson.show");
    Route::post("/{courseId}/{lessonId}/subLesson/{id}", "update")->name("subLesson.update");
    Route::delete("/{courseId}/{lessonId}/subLesson/{id}", "delete")->name("subLesson.delete");
});
Route::middleware('auth')->prefix('PDF')->controller(FileController::class)->group(function () {
    Route::get('/download/{fileName}','downloadFile')->name('downloadPDF');
    Route::get('/show/{fileName}','showFile')->name('showPDF');
});
Route::get('/back',function (){
    return redirect()->back();
})->name('back');

Route::middleware('auth')->controller(chatController::class)->group(function () {
    Route::get("/chat",'index')->name("chat.index");
    Route::get("/chat/{id}","show")->name("chat.show");
    Route::post("/chat","store")->name("chat.store");
    Route::get("/messages/{id}","messages")->name("chat.messages");
});


Route::middleware('auth')->prefix('admin')->controller(StudentController::class)->group(function () {
Route::get("/{role}", "index")->name("student.index");
Route::get("/{role}/create", "create")->name("student.create");
Route::post("/{role}", "store")->name("student.store");
Route::get("/{role}/{id}/edit", "edit")->name("student.edit");
Route::post("/{role}/{id}", "update")->name("student.update");
Route::delete("/{role}/{id}", "delete")->name("student.delete");
});
