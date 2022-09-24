<?php

use App\Http\Controllers\Api\DebtController;
use App\Http\Controllers\Api\FishermenController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MasterTransaksiOperasionalController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\TransaksiOperasionalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('products', ProductController::class);

Route::prefix('locations')->group(function() {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/store', [LocationController::class, 'store']);
    Route::patch('/update/{slug}', [LocationController::class, 'update']);
    Route::delete('/destroy/{slug}', [LocationController::class, 'destroy']);
});

Route::resource('fishermen', FishermenController::class);

Route::prefix('transactions')->group(function() {
    Route::get('/purchase/form', [PurchaseController::class,'form']);
    Route::post('/purchase', [PurchaseController::class, 'store']);
    Route::get('/purchase/pending', [PurchaseController::class, 'pending']);
});

Route::prefix('debt')->group(function() {
    Route::get('/form', [DebtController::class, 'index']);
    // Kasbon
    Route::get('/create/{fishermen_id}', [DebtController::class, 'create']);
    Route::post('/store/{fishermen_id}', [DebtController::class, 'store']);

    //Pembayaran
    Route::get('/payment/{id}', [DebtController::class, 'payment']);
    Route::patch('payment/{id}', [DebtController::class, 'payment_update']);
});

Route::resource('/master-transaksi-operasional', MasterTransaksiOperasionalController::class);

// Transaksi Operasional
Route::get('/transaksi-operasional/form', [TransaksiOperasionalController::class, 'form']);
Route::post('/transaksi-operasional/store', [TransaksiOperasionalController::class, 'store']);
