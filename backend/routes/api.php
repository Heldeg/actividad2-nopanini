<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('libraries', LibraryController::class);

Route::apiResource('orders', OrderController::class);

//USER CONTROLLERS
Route::post('admins/promote', [AdminController::class, 'promote'])->name('admins.promote');
Route::post('employees/promote', [EmployeeController::class, 'promote'])->name('employees.promote');
Route::apiResource('clients', ClientController::class);

Route::apiResource('employees', EmployeeController::class);

Route::apiResource('admins', AdminController::class);
