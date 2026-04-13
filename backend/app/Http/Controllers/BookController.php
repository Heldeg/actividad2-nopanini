<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|string|unique:books,isbn',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'edition_num' => 'nullable|integer',
            'language' => 'nullable|string',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|string',
            'editorial_id' => 'required|exists:editorials,editorial_id',
        ]);

        $book = Book::create($validatedData);
        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'edition_num' => 'nullable|integer',
            'language' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'cover_image' => 'nullable|string',
            'editorial_id' => 'sometimes|required|exists:editorials,editorial_id',
        ]);

        $book->update($validatedData);
        return response()->json($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Libro eliminado correctamente'], 200);
    }
    public function search(Request $request)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'isbn' => 'sometimes|string',
            'language' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price_min' => 'sometimes|numeric',
            'price_max' => 'sometimes|numeric',
            'category' => 'sometimes|string',
            'author' => 'sometimes|string'
        ]);

        if (empty($validated)) {
            return response()->json([
                'message' => 'parámetros de busqueda no validos'
            ], 400);
        }

        $query = Book::query();

        if (isset($validated['title'])) {
            $query->where('title', 'like', '%' . $validated['title'] . '%');
        }

        if (isset($validated['isbn'])) {
            $query->where('isbn', $validated['isbn']);
        }

        if (isset($validated['language'])) {
            $query->where('language', 'like', '%' . $validated['language'] . '%');
        }

        if (isset($validated['description'])) {
            $query->where('description', 'like', '%' . $validated['description'] . '%');
        }

        if (isset($validated['price_min'])) {
            $query->where('price', '>=', $validated['price_min']);
        }

        if (isset($validated['price_max'])) {
            $query->where('price', '<=', $validated['price_max']);
        }
        if (isset($validated['category'])) {
            $query->whereHas('categories', function ($q) use ($validated) {
                $q->where('categories.name', 'like', '%' . $validated['category'] . '%');
            });
        }

        if (isset($validated['author'])) {
            $query->whereHas('authors', function ($q) use ($validated) {
                $q->where('authors.full_name', 'like', '%' . $validated['author'] . '%');
            });
        }
        

        $books = $query->get();
        return response()->json($books);
    }    
}
