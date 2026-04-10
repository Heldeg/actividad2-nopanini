<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $editorials = Editorial::all();
        return response()->json($editorials);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tel_number' => 'required|string',
            'name' => 'required|string'
        ]);

        $editorial = DB::transaction(function () use ($validatedData) {
            $property = Property::create([
                'name' => $validatedData['name'],
            ]);

            return Editorial::create([
                'editorial_id' => $property->id,
                'tel_number' => $validatedData['tel_number']
            ]);
        });
        $editorial->load('property');
        return response()->json($editorial, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Editorial $editorial)
    {
        if (!$editorial) {
            return response()->json(['message' => 'Editorial no encontrada'], 404);
        }
        $editorial->load('property');
        return response()->json($editorial);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Editorial $editorial)
    {
        if (!$editorial) {
            return response()->json(['message' => 'Editorial no encontrada'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'tel_number' => 'sometimes|required|string'
        ]);
        DB::transaction(function () use ($validatedData, $editorial) {
            if (isset($validatedData['name'])) {
                $editorial->property->update(['name' => $validatedData['name']]);
            }
            if (isset($validatedData['tel_number'])) {
                $editorial->update(['tel_number' => $validatedData['tel_number']]);
            }
        });
        return response()->json($editorial->load('property'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Editorial $editorial)
    {
        if (!$editorial) {
            return response()->json(['message' => 'Editorial no encontrada'], 404);
        }
        $editorial->delete();
        return response()->json(['message' => 'Editorial eliminada correctamente'], 200);
    }
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'tel_number' => 'sometimes|string'
        ]);
        if (empty($validatedData)) {
            return response()->json([
                'message' => 'parámetros de busqueda no validos'
            ], 400);
        }
        $query = Editorial::query();

        if (isset($validatedData['tel_number'])) {
            $query->where('tel_number', 'like', '%' . $validatedData['tel_number'] . '%');
        }

        $editorials = $query->get();
        return response()->json($editorials);
    }    
}
