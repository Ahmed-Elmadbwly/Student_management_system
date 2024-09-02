<?php

use App\Http\Controllers\admin\classController;
use App\Http\Controllers\admin\studentController;
use App\Http\Controllers\chatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\admin\categoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


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

require __DIR__.'/auth.php';
