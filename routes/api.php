<?php

use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductMoveController;
use App\Http\Controllers\Api\V1\StockController;
use App\Http\Controllers\Api\V1\WarehouseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {

	Route::get('products/moves', [ProductMoveController::class, 'index']);
	Route::apiResource('products', ProductController::class);
	Route::apiResource('warehouses', WarehouseController::class);
	Route::apiResource('stocks', StockController::class)->only(['index', 'show']);

	Route::prefix('orders')->controller(OrderController::class)->group(function () {
		Route::get('', 'index');
		Route::post('', 'store');

		Route::prefix('{order}')->group(function () {
			Route::patch('', 'update');
			Route::patch('complete', 'complete');
			Route::patch('cancel', 'cancel');
			Route::patch('resume', 'resume');
		});

	});

});


