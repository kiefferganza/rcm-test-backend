<?php

use App\Http\Controllers\API\AuthAPIController;
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

Route::post('login', [AuthAPIController::class, 'login']);
Route::post('logout', [AuthAPIController::class, 'logout'])->middleware('auth:api');

Route::resource('users', App\Http\Controllers\API\UserAPIController::class)
    ->except(['create', 'edit']);


Route::resource('employees', App\Http\Controllers\API\EmployeeAPIController::class)
    ->except(['create', 'edit']);