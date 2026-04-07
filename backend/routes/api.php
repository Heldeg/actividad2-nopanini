<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# Rutas para la gestión de libros
Route::get('/books', [BookController::class, 'index'])->name('api.books.index');
# Ruta para la busqueda de libros por palabras clave en el título, descripción, isbn o idioma
Route::get('/books/search', [BookController::class, 'search'])->name('api.books.search');
# Ruta para mostrar un libro específico por su ISBN
Route::get('/books/{isbn}', [BookController::class, 'show'])->name('api.books.show');
# Ruta para crear un nuevo libro
Route::post('/books', [BookController::class, 'store'])->name('api.books.store');
# Ruta para actualizar un libro existente por su ISBN
Route::put('/books/{isbn}', [BookController::class, 'update'])->name('api.books.update');
# Ruta para eliminar un libro por su ISBN
Route::delete('/books/{isbn}', [BookController::class, 'destroy'])->name('api.books.destroy');

# Ruta para la gestión de autores
Route::get('/authors', [AuthorController::class, 'index'])->name('api.authors.index');
# Ruta para la busqueda de autores por palabras clave en el nombre completo, país, Genero, fecha de nacimiento o fecha de muerte
Route::get('/authors/search', [AuthorController::class, 'search'])->name('api.authors.search');
# Ruta para mostrar un autor específico por su ID
Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('api.authors.show');
# Ruta para crear un nuevo autor
Route::post('/authors', [AuthorController::class, 'store'])->name('api.authors.store');
# Ruta para actualizar un autor existente por su ID
Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('api.authors.update');
# Ruta para eliminar un autor por su ID
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('api.authors.destroy');

# Ruta para la gestión de editoriales
Route::get('/editorials', [EditorialController::class, 'index'])->name('api.editorials.index');
# Ruta para la busqueda de editoriales por palabras clave en el número de teléfono
Route::get('/editorials/search', [EditorialController::class, 'search'])->name('api.editorials.search');
# Ruta api de prueba para verificar que el backend está funcionando correctamente
Route::get('editorials/{id}', [EditorialController::class, 'show'])->name('api.editorials.show');
# Ruta para crear una nueva editorial
Route::post('/editorials', [EditorialController::class, 'store'])->name('api.editorials.store');
# Ruta para actualizar una editorial existente por su ID
Route::put('/editorials/{id}', [EditorialController::class, 'update'])->name('api.editorials.update');
# Ruta para eliminar una editorial por su ID
Route::delete('/editorials/{id}', [EditorialController::class, 'destroy'])->name('api.editorials.destroy');

# Ruta para la gestión de categorías
Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
# Ruta para la busqueda de categorías por palabras clave en el nombre
Route::get('/categories/search', [CategoryController::class, 'search'])->name('api.categories.search');
# Ruta para mostrar una categoría específica por su ID
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('api.categories.show');
# Ruta para crear una nueva categoría
Route::post('/categories', [CategoryController::class, 'store'])->name('api.categories.store');
# Ruta para actualizar una categoría existente por su ID
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('api.categories.update');
# Ruta para eliminar una categoría por su ID
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');

Route::get('/saludo', function () {
    return response()->json([
        'mensaje' => '¡Hola! El backend está funcionando correctamente',
        'estado' => 'ok'
    ]);
});
