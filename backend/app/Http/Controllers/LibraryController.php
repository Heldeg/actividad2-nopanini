<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libraries = Library::all();
        return response()->json($libraries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'address' => 'required|string|max:200',
            'tel_number' => 'required|string|max:20',
        ]);

        $library = Library::create($validatedData);
        return response()->json($library, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Library $library)
    {
        return response()->json($library);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'address' => 'required|string|max:200',
            'tel_number' => 'required|string|max:20',
        ]);

        $library->update($validatedData);
        return response()->json($library);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        $library->delete();
        return response()->json(null, 204);
    }
}
