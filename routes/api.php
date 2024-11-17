<?php

use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\ProductController;
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

	Route::apiResource('products', ProductController::class);
	Route::apiResource('warehouses', WarehouseController::class);

	Route::controller(OrderController::class)->group(function () {
		Route::get('orders', 'index');
		Route::post('orders', 'store');
	});

});


