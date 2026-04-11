<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\CategoryController;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('libraries', LibraryController::class);

Route::apiResource('orders', OrderController::class);

//USER CONTROLLERS
Route::post('admins/promote', [AdminController::class, 'promote'])->name('api.admins.promote');
Route::post('employees/promote', [EmployeeController::class, 'promote'])->name('api.employees.promote');
Route::apiResource('clients', ClientController::class);

Route::apiResource('employees', EmployeeController::class);

Route::apiResource('admins', AdminController::class);

Route::get('/books/search', [BookController::class, 'search'])->name('api.books.search');
Route::apiResource('books', BookController::class);

Route::get('/authors/search', [AuthorController::class, 'search'])->name('api.authors.search');
Route::apiResource('authors', AuthorController::class);

Route::get('/editorials/search', [EditorialController::class, 'search'])->name('api.editorials.search');
Route::apiResource('editorials', EditorialController::class);

Route::get('/categories/search', [CategoryController::class, 'search'])->name('api.categories.search');
Route::apiResource('categories', CategoryController::class);

Route::get('/inventories/search', [InventoryController::class, 'search'])->name('api.inventories.search');
Route::apiResource('inventories', InventoryController::class);

Route::get('/saludo', function () {
    return response()->json([
        'mensaje' => '¡Hola! El backend está funcionando correctamente',
        'estado' => 'ok'
    ]);
});