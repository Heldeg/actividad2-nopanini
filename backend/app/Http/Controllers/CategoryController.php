<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        return response()->json($category);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'property_id' => 'required|integer|unique:category,property_id',
            'name' => 'required|string'
        ]);
        $property = Property::create($validatedData);
        $category = Category::create($validatedData);
        return response()->json($category, 201);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'parent_category' => 'sometimes|integer|exists:category,property_id'
        ]);
        $category->update($validatedData);
        return response()->json($category);
    }
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Categoría no encontrada'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Categoría eliminada']);
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
