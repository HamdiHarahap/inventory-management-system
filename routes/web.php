<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    })->name('dashboard');

    Route::get('/kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/tambah-kategori', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/tambah-kategori', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit-kategori/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/edit-kategori/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.add');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});