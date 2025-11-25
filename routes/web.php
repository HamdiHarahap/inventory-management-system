<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.create');
    Route::post('/tambah-produk', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit-produk/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/edit-produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/pengguna', [UserController::class, 'index'])->name('user.index');
    Route::get('/tambah-pengguna', [UserController::class, 'create'])->name('user.create');
    Route::post('/tambah-pengguna', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-pengguna/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/edit-pengguna/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/pengguna/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    Route::get('/aktivitas', [ActivityLogController::class, 'index'])->name('activity.index');

    Route::get('/barcode/{code}', [BarcodeController::class, 'generateBarcode']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});