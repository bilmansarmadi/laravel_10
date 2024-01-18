<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProvinceController;

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


Route::post('/users/register', [UserController::class, 'register']);
Route::post('/users/login', [UserController::class, 'login']);

Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function (){
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/get', [UserController::class, 'get']);
    Route::get('/employees/getdata', [EmployeeController::class, 'GetData']);
    Route::post('/employees', [EmployeeController::class, 'store']);
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])
    ->where('id', '[0-9]+');
    Route::delete('/employees/{id}', [EmployeeController::class, 'delete'])
    ->where('id', '[0-9]+');
    Route::get('/banks', [BankController::class, 'index']);
    Route::get('/provinces', [ProvinceController::class, 'index']);
    Route::get('/city', [CityController::class, 'index']);
    Route::get('/positions', [PositionController::class, 'index']);
});

