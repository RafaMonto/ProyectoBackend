<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Return all suppliers with sorting
        $sort = $request->input('sort', 'name'); // Default sorting field
        $type = $request->input('type', 'asc'); // Default sorting type

        $validType = ['asc', 'desc']; // Valid sorting types

        if (!in_array($type, $validType, true)) {
            $message = "Invalid sort type: $type";

            return response()->json(['data' => $message], 400);
        }

        $validSort = ['name', 'email', 'phone', 'address']; // Valid sorting fields

        if (!in_array($sort, $validSort, true)) {
            $message = "Invalid sort field: $sort";

            return response()->json(['data' => $message], 400);
        }

        $suppliers = Supplier::orderBy($sort, $type)->get();

        return response()->json(['data' => $suppliers], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'productsOffered' => 'required|array',
        ]);

        // Create the supplier
        $supplier = Supplier::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'productsOffered' => json_encode($validated['productsOffered']),
        ]);

        return response()->json(['data' => $supplier], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        // Return a specific supplier
        return response()->json(['data' => $supplier], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:255',
            'productsOffered' => 'sometimes|array',
        ]);

        // Update the supplier
        $supplier->update([
            'name' => $validated['name'] ?? $supplier->name,
            'email' => $validated['email'] ?? $supplier->email,
            'phone' => $validated['phone'] ?? $supplier->phone,
            'address' => $validated['address'] ?? $supplier->address,
            'productsOffered' => isset($validated['productsOffered']) ? json_encode($validated['productsOffered']) : $supplier->productsOffered,
        ]);

        return response()->json(['data' => $supplier], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // Delete the supplier
        $supplier->delete();

        return response()->json(null, 204);
    }
}
