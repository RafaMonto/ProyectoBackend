<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el campo de ordenamiento y el tipo de ordenamiento
        $sort = $request->input('sort', 'name');
        $type = $request->input('type', 'asc');

        // Validar el tipo de orden
        $validType = ['asc', 'desc'];

        if (!in_array($type, $validType, true)) {
            $message = "Invalid sort type: $type";

            return response()->json(['data' => $message], 400);
        }

        // Validar los campos de ordenamiento
        $validSort = ['name'];

        if (!in_array($sort, $validSort, true)) {
            $message = "Invalid sort field: $sort";

            return response()->json(['data' => $message], 400);
        }

        // Obtener las categorías ordenadas
        $categories = Category::orderBy($sort, $type)->get();

        return response()->json([new CategoryCollection($categories)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // Crear una nueva categoría
        $category = Category::create($validated);

        return response()->json(['data' => new CategoryResource($category)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retornar una categoría específica
        $category = Category::findOrFail($id);
        return response()->json(['data' => new CategoryResource($category)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        // Actualizar la categoría
        $category->update($validated);

        return response()->json(['data' => new CategoryResource($category)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Eliminar la categoría
        $category->delete();

        return response()->json(null, 204);
    }
}
