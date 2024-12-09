<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
 */

Route::get('/dish',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/dish/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/inventory',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/inventory/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/employee',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/employee/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/supplier',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/supplier/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/invoice',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/invoice/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/category',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/category/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/sale',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/sale/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::get('/inventory',
    [App\Http\Controllers\DishController::class, 'index']);
Route::get('/inventory/{id}',
    [App\Http\Controllers\DishController::class, 'show']);

Route::post('/v1/login',
    [App\Http\Controllers\api\v1\AuthController::class,
        'login'])->name('api.login');

Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('/v1/logout',
    [App\Http\Controllers\api\v1\AuthController::class,
    'logout'])->name('api.logout');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('/dish',
        App\Http\Controllers\DishController::class)->except('index', 'show');
    Route::apiResource('/inventory',
        App\Http\Controllers\InventoryController::class)->except('index', 'show');
    Route::apiResource('/employee',
        App\Http\Controllers\EmployeeController::class)->except('index', 'show');
    Route::apiResource('/supplier',
        App\Http\Controllers\SupplierController::class)->except('index', 'show');
    Route::apiResource('/invoice',
        App\Http\Controllers\InvoiceController::class)->except('index', 'show');
    Route::apiResource('/category',
        App\Http\Controllers\CategoryController::class)->except('index', 'show');
    Route::apiResource('/sale',
        App\Http\Controllers\SaleController::class)->except('index', 'show');
    Route::apiResource('/inventory',
        App\Http\Controllers\InventoryController::class)->except('index', 'show');

    Route::get('/reports/sales',
        [App\Http\Controllers\ReportController::class, 'salesReport']);
    Route::get('/reports/employees',
        [App\Http\Controllers\ReportController::class, 'employeeReport']);
    Route::get('/reports/dishes',
        [App\Http\Controllers\ReportController::class, 'dishesReport']);
});

Route::apiResource('/menus',
App\Http\Controllers\MenuController::class);
