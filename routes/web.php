<?php

use App\Http\Controllers\AuthController;
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

    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/tambah-produk', [ProductController::class, 'create'])->name('product.add');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});