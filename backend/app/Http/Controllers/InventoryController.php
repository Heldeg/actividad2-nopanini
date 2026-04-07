<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return response()->json($inventories);
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        if ($inventory) {
            return response()->json($inventory);
        } else {
            return response()->json(['message' => 'Elemento no encontrado'], 404);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'isbn' => 'required|string|exists:book,isbn',
            'quantity' => 'required|integer|min:0',
        ]);
        $inventory = Inventory::create($request->all());
        return response()->json($inventory, 201);
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        if ($inventory) {
            $inventory->update($request->all());
            return response()->json($inventory);
        } else {
            return response()->json(['message' => 'Inventory not found'], 404);
        }
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        if ($inventory) {
            $inventory->delete();
            return response()->json(['message' => 'Inventory deleted']);
        } else {
            return response()->json(['message' => 'Inventory not found'], 404);
        }
    }
}
