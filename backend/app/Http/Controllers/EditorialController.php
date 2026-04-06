<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;

class EditorialController extends Controller
{
    public function index()
    {
        $editorials = Editorial::all();
        return response()->json($editorials);
    }
    public function show($id)
    {
        $editorial = Editorial::find($id);
        if (!$editorial) {
            return response()->json(['message' => 'Editorial no encontrada'], 404);
        }
        return response()->json($editorial);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'required|integer|unique:editorial,property_id',
            'tel_number' => 'required|string'
        ]);
        $editorial = Editorial::create($validatedData);
        return response()->json($editorial, 201);
    }
    public function update(Request $request, $id)
    {
        $editorial = Editorial::find($id);
        if (!$editorial) {
            return response()->json(['message' => 'Editorial no encontrada'], 404);
        }
        $validatedData = $request->validate([
            'property_id' => 'required|integer|unique:editorial,property_id',
            'tel_number' => 'sometimes|required|string'
        ]);
        $editorial->update($validatedData);
        return response()->json($editorial);
    }
    public function destroy($id)
    {
        $editorial = Editorial::find($id);
        if (!$editorial) {
            return response()->json(['message' => 'Editorial no encontrada'], 404);
        }
        $editorial->delete();
        return response()->json(['message' => 'Editorial eliminada correctamente'], 200);
    }
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'sometimes|integer',
            'tel_number' => 'sometimes|string'
        ]);
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'parámetros de busqueda no validos'
            ], 400);
        }
        $query = Editorial::query();
        if (isset($validatedData['property_id'])) {
            $query->where('property_id', $validatedData['property_id']);
        }
        if (isset($validatedData['tel_number'])) {
            $query->where('tel_number', 'like', '%' . $validatedData['tel_number'] . '%');
        }

        $editorials = $query->get();
        return response()->json($editorials);
    }
}