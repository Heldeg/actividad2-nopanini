<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::all();
        return response()->json($inventories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer',
            'location' => 'required|string|max:255',
            'library_id' => 'required|exists:libraries,id',
            'isbn' => 'required|exists:books,isbn'
        ]);

        $inventory = Inventory::create($validatedData);
        return response()->json($inventory, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return response()->json($inventory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validatedData = $request->validate([
            'quantity' => 'sometimes|required|integer',
            'location' => 'sometimes|required|string|max:255',
            'library_id' => 'sometimes|required|exists:libraries,id',
            'isbn' => 'sometimes|required|exists:books,isbn'
        ]);

        $inventory->update($validatedData);
        return response()->json($inventory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return response()->json(['message' => 'Inventory deleted successfully'], 200);
    }

public function search(Request $request)
    {
        $validated = $request->validate([
            'library_id' => 'nullable|exists:libraries,id',
            'isbn' => 'nullable|string|exists:books,isbn',
            'location' => 'nullable|string',
            'min_quantity' => 'nullable|integer|min:0',
            'max_quantity' => 'nullable|integer|min:0'
        ]);

        if (empty(array_filter($validated))) {
            return response()->json([
                'message' => 'Parámetros de búsqueda no válidos o vacíos'
            ], 400);
        }

        $query = Inventory::query();

        if (isset($validated['library_id'])) {
            $query->where('library_id', $validated['library_id']);
        }

        if (isset($validated['isbn'])) {
            $query->where('isbn', $validated['isbn']);
        }

        if (isset($validated['location'])) {
            $query->where('location', 'like', '%' . $validated['location'] . '%');
        }

        if (isset($validated['min_quantity'])) {
            $query->where('quantity', '>=', $validated['min_quantity']);
        }

        if (isset($validated['max_quantity'])) {
            $query->where('quantity', '<=', $validated['max_quantity']);
        }

        $inventories = $query->with(['book', 'library'])->get();

        return response()->json($inventories);
    }    
}
