<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

Route::apiResource('/dish',
App\Http\Controllers\DishController::class);

Route::apiResource('/inventory',
App\Http\Controllers\InventoryController::class);

Route::apiResource('/employee',
App\Http\Controllers\EmployeeController::class);

Route::apiResource('/supplier',
App\Http\Controllers\SupplierController::class);

