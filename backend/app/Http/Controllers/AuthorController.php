<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }
    public function show($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }
        return response()->json($author);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'required|integer|unique:author,property_id',
            'full_name' => 'required|string',
            'gender' => 'required|string|in:M,F,O',
            'country' => 'required|string',
            'birth_date' => 'required|date',
            'death_date' => 'nullable|date|after_or_equal:birth_date'
        ]);

        $author = Author::create($validatedData);
        return response()->json($author, 201);
    }
    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'full_name' => 'sometimes|required|string',
            'gender' => 'sometimes|required|string|in:M,F,O',
            'country' => 'sometimes|required|string',
            'birth_date' => 'sometimes|required|date',
            'death_date' => 'sometimes|nullable|date|after_or_equal:birth_date'
        ]);

        $author->update($validatedData);
        return response()->json($author);
    }
    public function destroy($id)
    {
        $author = Author::find($id);
        if (!$author) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }
        $author->delete();
        return response()->json(['message' => 'Autor eliminado correctamente'], 200);
    }
    public function search(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'nullable|string',
            'country' => 'nullable|string',
            'gender' => 'nullable|string|in:M,F,O',
            'birth_date' => 'nullable|date',
            'death_date' => 'nullable|date'
        ]);

        if (empty($validated)) {
            return response()->json([
                'message' => 'parámetros de busqueda no validos'
            ], 400);
        }
        $query = Author::query();
        if (isset($validated['full_name'])) {
            $query->where('full_name', 'like', '%' . $validated['full_name'] . '%');
        }
        if (isset($validated['country'])) {
            $query->where('country', 'like', '%' . $validated['country'] . '%');
        }
        if (isset($validated['gender'])) {
            $query->where('gender', $validated['gender']);
        }
        if (isset($validated['birth_date'])) {
            $query->where('birth_date', $validated['birth_date']);
        }
        if (isset($validated['death_date'])) {
            $query->where('death_date', $validated['death_date']);
        }

        $authors = $query->get();
        return response()->json($authors);
    }
}