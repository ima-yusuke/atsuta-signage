<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// TOPページ
Route::get('/', [MainController::class, 'ShowPage'])->name('show.page');

// ダッシュボード
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // カテゴリー
    Route::get("/dashboard/category",[AdminController::class,"ShowCategory"])->name("ShowCategory");
    Route::post("/dashboard/category",[AdminController::class,"AddCategory"])->name("AddCategory");
    Route::post('/dashboard/category/{id}', [AdminController::class,"UpdateCategory"])->name('UpdateCategory');
    Route::delete("/dashboard/category/{id}",[AdminController::class,"DeleteCategory"])->name("DeleteCategory");

});

require __DIR__.'/auth.php';
