<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'parent_category' => 'nullable|integer|exists:categories,category_id'
        ]);
        $category = DB::transaction(function () use ($validatedData) {
            $property = Property::create([
                'name' => $validatedData['name'],
            ]);
            return Category::create([
                'category_id' => $property->id,
                'name' => $validatedData['name'],
                'parent_category_id' => $validatedData['parent_category'] ?? null
            ]);
        });
        $category->load('property');
        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'parent_category' => 'sometimes|integer|exists:category,category_id'
        ]);
        DB::transaction(function () use ($validatedData, $category) {
            if (isset($validatedData['name'])) {
                $category->property->update(['name' => $validatedData['name']]);
                $category->name = $validatedData['name'];
            }
            if (isset($validatedData['parent_category'])) {
                $category->parent_category_id = $validatedData['parent_category'];
            }
            $category->save();
        });
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Categoría eliminada'], 200);
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|string'
        ]);
        if (empty($validatedData)) {
            return response()->json(['message' => 'Parametros de busqueda no validos'], 400);
        }
        $query = Category::query();
        if (isset($validatedData['name'])) {
            $query->where('name', 'like', '%' . $validatedData['name'] . '%');
        }
        $categories = $query->get();
        return response()->json($categories);
    }
}
