<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }
    public function show($isbn)
    {
        $book = Book::with(['editorial', 'author', 'category'])->find($isbn);
        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        return response()->json($book);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|string|unique:book,isbn',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'edition_num' => 'nullable|integer',
            'language' => 'nullable|string',
            'price' => 'required|numeric',
            'cover_image' => 'nullable|string',
            'editorial' => 'required|exists:editorial,property_id',
        ]);

        $book = Book::create($validatedData);
        return response()->json($book, 201);
    }
    public function update(Request $request, $isbn)
    {
        $book = Book::find($isbn);
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
            'editorial' => 'sometimes|required|exists:editorial,property_id',
        ]);

        $book->update($validatedData);
        return response()->json($book);
    }
    public function destroy($isbn)
    {
        $book = Book::find($isbn);
        if (!$book) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Libro eliminado correctamente'], 200);
    }

    # Método para buscar los libros por cualquiera de sus campos
    public function search(Request $request)
    {
        $validated = $request->validate([
            'title' => 'sometimes|string',
            'isbn' => 'sometimes|string',
            'language' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price_min' => 'sometimes|numeric',
            'price_max' => 'sometimes|numeric',
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

        $books = $query->get();
        return response()->json($books);
    }
}