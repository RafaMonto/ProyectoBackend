<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Resources\SaleCollection;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //mostar todas las ventas
        $sort = $request->input('sort', 'total');
        $type = $request->input('type', 'asc');

        $validType = ['asc', 'desc'];

        if (! in_array($type, $validType, true)) {
            $message = "Invalid sort type: $type";

            return response()->
                json(['data' => $message], 400);
        }

        $validSort = ['total','employee_id','dishes'];

        if (! in_array($sort, $validSort, true)) {
            $message = "Invalid sort field: $sort";

            return response()->
                json(['data' => $message], 400);
        }

        $sales = Sale::orderBy($sort, $type)->get();

        return response()->
            json([new SaleCollection($sales)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //crear venta
        $sale = Sale::create($request->all());

        return response()->
            json(['data' => $sale], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //ver venta n
        $sale = Sale::findOrFail($id);
        return response()->
            json(['data' => $sale], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //actualizar venta
        $sale->update($request->all());

        return response()->
            json(['data' => $sale], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //eliminar venta
        $sale->delete();

        return response()->
            json(null, 200);
    }
}
