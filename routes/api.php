<?php

use App\Http\Controllers\Api\SalesController;
use App\Http\Controllers\Api\SalesDataController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sales', [SalesController::class,'index']);
Route::get('/sales/all', [SalesDataController::class, 'all']);
Route::get('/sales/customers', [SalesDataController::class, 'customers']);
Route::get('/sales/employees', [SalesDataController::class, 'employees']);
Route::get('/sales/products', [SalesDataController::class, 'products']);
