<?php

use App\Http\Controllers\DebtController;
use App\Http\Controllers\FishermenController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SackController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->middleware(['auth'])->group(function() {
    Route::get('/fishermen', [FishermenController::class, 'index'])->name('fishermen.index');
    Route::get('/fishermen/create', [FishermenController::class, 'create'])->name('fishermen.create');
    Route::post('/fihsermen/store', [FishermenController::class, 'store'])->name('fishermen.store');
    Route::get('/fishermen/list', [FishermenController::class, 'list'])->name('fishermen.list');
    Route::get('/fishermen/show/{id}', [FishermenController::class, 'show'])->name('fishermen.show');

    // Master Location
    Route::get('/locations', [LocationController::class, 'index'])->name('location.index');
    Route::post('/locations/store', [LocationController::class, 'store'])->name('location.store');
    Route::patch('/locations/update/{slug}', [LocationController::class, 'update'])->name('location.update');
    Route::delete('/locations/destroy/{slug}', [LocationController::class, 'destroy'])->name('location.destroy');

    // Master Produk
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    Route::patch('/products/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Tansaksi
    Route::prefix('/transactions')->group(function() {
        Route::get('/', [TransactionController::class, 'index'])->name('tr.index');

        // Transaksi Pembelian Produk
        Route::get('/purchase/form', [PurchaseController::class, 'form'])->name('purchase.form');
        Route::post('/purchase', [PurchaseController::class, 'store'])->name('purchase.store');

        // Transaksi Pending
        Route::get('/purchase/pending', [PurchaseController::class, 'pending'])->name('purchase.pending');
        Route::patch('/purchase/upload-receipt/{id}', [PurchaseController::class, 'upload_receipt'])->name('purchase.upload-receipt');

        //Transaksi Selesai
        Route::get('/purchase/success', [PurchaseController::class, 'success'])->name('purchase.success');

        // Data Transaksi
        Route::get('/purchase/list', [PurchaseController::class, 'list'])->name('purchase.list');

    });


    // Kasbon
    Route::get('/kasbon', [DebtController::class, 'index'])->name('debt.index');
    Route::get('/kasbon/form/{fishermen_id}', [DebtController::class, 'form'])->name('debt.form');
    Route::post('/kasbon/{fishermen_id}', [DebtController::class, 'submission'])->name('debt.submission');

    // Kasbon Pembayaran
    Route::get('/kasbon/pembayaran/form/{id}', [DebtController::class, 'payment_form'])->name('debt.payment_form');
    Route::patch('/kasbon/pembayaran/{id}', [DebtController::class, 'payment_update'])->name('debt.payment-update');

    //Karung
    Route::get('/karung', [SackController::class, 'index'])->name('sack.index');
    Route::get('/karung/form/{fishermen_id}', [SackController::class, 'create'])->name('sack.create');
    Route::post('/karung/{fishermen}', [SackController::class, 'store'])->name('sack.store');
    Route::patch('/karung/pengembalian/{id}', [SackController::class, 'update'])->name('sack.update');

});
