<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\MenuCollection;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el campo de ordenamiento y el tipo de ordenamiento
        $sort = $request->input('sort', 'date'); // Campo por defecto
        $type = $request->input('type', 'asc'); // Orden por defecto

        $validType = ['asc', 'desc']; // Tipos válidos de ordenamiento
        if (!in_array($type, $validType, true)) {
            return response()->json(['message' => "Invalid sort type: $type"], 400);
        }

        $validSort = ['date']; // Campos válidos para ordenar
        if (!in_array($sort, $validSort, true)) {
            return response()->json(['message' => "Invalid sort field: $sort"], 400);
        }

        // Filtrar por fecha si se proporciona
        $date = $request->input('date');
        if ($date) {
            // Validar que la fecha esté en el formato correcto
            if (!preg_match('/\d{4}-\d{2}-\d{2}/', $date)) {
                return response()->json(['message' => "Invalid date format. Use YYYY-MM-DD."], 400);
            }

            // Buscar menús en la fecha específica
            $menus = Menu::with('dishes')->where('date', $date)->orderBy($sort, $type)->get();
        } else {
            // Si no se proporciona fecha, listar todos los menús
            $menus = Menu::with('dishes')->orderBy($sort, $type)->get();
        }

        return response()->json(['data' => $menus], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'date' => 'required|date|unique:menus,date',
            'dishes' => 'required|array',
            'dishes.*' => 'exists:dishes,id',
        ]);

        // Crear el menú
        $menu = Menu::create(['date' => $validated['date']]);

        // Asociar los platos al menú
        $menu->dishes()->sync($validated['dishes']);

        return response()->json(['data' => $menu->load('dishes')], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        // Ver un menú específico con sus platos
        return response()->json(['data' => $menu->load('dishes')], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'dishes' => 'required|array',
            'dishes.*' => 'exists:dishes,id',
        ]);

        // Actualizar los platos del menú
        $menu->dishes()->sync($validated['dishes']);

        return response()->json(['data' => $menu->load('dishes')], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Eliminar el menú
        $menu->delete();

        return response()->json(null, 204);
    }
}
