<?php

namespace App\Http\Controllers;

use App\Http\Resources\InventoryCollection;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //return de todos los inventarios
        $sort = $request->input('sort', 'name');
        $type = $request->input('type', 'asc');

        $validType = ['asc', 'desc'];

        if (! in_array($type, $validType, true)) {
            $message = "Invalid sort type: $type";

            return response()->
                json(['data' => $message], 400);
        }

        $validSort = ['name','quantity','purchase_price','supplier_id'];

        if (! in_array($sort, $validSort, true)) {
            $message = "Invalid sort field: $sort";

            return response()->
                json(['data' => $message], 400);
        }

        $inventories = Inventory::orderBy($sort, $type)->get();

        return response()->
            json([new InventoryCollection($inventories)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //crear inventario
        $inventory = Inventory::create($request->all());

        return response()->
            json(['data' => $inventory], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //ver inventario n
        return response()->
            json(['data' => new InventoryResource($inventory)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //actualizar inventario
        $inventory->update($request->all());

        return response()->
            json(['data' => $inventory], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //eliminar inventario
        $inventory->delete();

        return response()->
            json(null, 200);
    }
}
