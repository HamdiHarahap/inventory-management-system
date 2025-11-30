<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomingTransactionController;
use App\Http\Controllers\OutgoingTransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::get('/tambah-kategori', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/edit-kategori/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/tambah-kategori', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/edit-kategori/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

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

        Route::get('/tambah-customer', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/tambah-customer', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('/edit-customer/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::put('/edit-customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
        Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

        Route::get('/tambah-supplier', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/tambah-supplier', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('/edit-supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

        Route::get('/ubah-stok', [StockAdjustmentController::class, 'index'])->name('stock.index');
        Route::post('/ubah-stok', [StockAdjustmentController::class, 'store'])->name('stock.store');
    });

    Route::middleware('role:staff')->group(function () {
        Route::get('/tambah-transaksi-masuk', [IncomingTransactionController::class, 'create'])->name('incoming.create');
        Route::post('/tambah-transaksi-masuk', [IncomingTransactionController::class, 'store'])->name('incoming.store');

        Route::get('/tambah-transaksi-keluar', [OutgoingTransactionController::class, 'create'])->name('outgoing.create');
        Route::post('/tambah-transaksi-keluar', [OutgoingTransactionController::class, 'store'])->name('outgoing.store');
    });

    Route::middleware('role:manager')->group(function () {
        Route::get('/aktivitas', [ActivityLogController::class, 'index'])->name('activity.index');
    });

    Route::get('/kategori', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');

    Route::get('/transaksi-masuk', [IncomingTransactionController::class, 'index'])->name('incoming.index');
    Route::get('/transaksi-keluar', [OutgoingTransactionController::class, 'index'])->name('outgoing.index');

    Route::get('/barcode/{code}', [BarcodeController::class, 'generateBarcode']);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});