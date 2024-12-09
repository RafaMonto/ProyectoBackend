<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use App\Http\Resources\DishCollection;
use App\Http\Resources\DishResource;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        /* $dishes = Dish::orderBy('name', 'asc')->get();

        return response()->json(['data' => $dishes], 200); */
        //return de todos los platos
        $sort = $request->input('sort', 'name');//campo por el que se ordena
        $type = $request->input('type', 'asc');//tipo de orden

        $validType = ['asc', 'desc'];//tipos de orden validos

        if (! in_array($type, $validType, true)) {//si el tipo de orden no es valido
            $message = "Invalid sort type: $type";//mensaje de error

            return response()->//devolver mensaje de error
                json(['data' => $message], 400);//codigo de error 400
        }

        $validSort = ['name','description','price','availability','category_id'];//campos por los que se puede ordenar

        if (! in_array($sort, $validSort, true)) {//si el campo por el que se ordena no es valido
            $message = "Invalid sort field: $sort";//mensaje de error

            return response()->
                json(['data' => $message], 400);
        }

        $dishes = Dish::orderBy($sort, $type)->get();//obtener cabañas ordenadas

        return response()->//devolver cabañas
            //json(['data' => CabinResource::collection($cabins)], 200);//codigo 200
            json([new DishCollection($dishes)], 200);//codigo 200
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //crear plato
        $dish = Dish::create($request->all());

        return response()->
            json(['data' => $dish], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //ver plato n
        $dish = Dish::findOrFail($id);
        return response()->
            json(['data' => new DishResource($dish)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dish $dish)
    {
        //actualizar plato
        $dish->update($request->all());

        return response()->
            json(['data' => $dish], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        //eliminar plato
        $dish->delete();

        return response()->
            json(null, 200);
    }
}
