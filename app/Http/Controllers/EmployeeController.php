<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el orden y tipo de ordenamiento de los empleados
        $sort = $request->input('sort', 'name'); // Campo de ordenamiento por defecto: 'name'
        $type = $request->input('type', 'asc'); // Tipo de ordenamiento por defecto: 'asc'

        $validType = ['asc', 'desc']; // Tipos de ordenamiento válidos

        if (!in_array($type, $validType, true)) {
            $message = "Invalid sort type: $type";

            return response()->json(['data' => $message], 400);
        }

        $validSort = ['name', 'lastName', 'charge', 'salary', 'email', 'phone', 'schedule']; // Campos válidos para ordenar

        if (!in_array($sort, $validSort, true)) {
            $message = "Invalid sort field: $sort";

            return response()->json(['data' => $message], 400);
        }

        $employees = Employee::orderBy($sort, $type)->get();

        return response()->json([new EmployeeCollection($employees)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'charge' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|string|max:15',
            'schedule' => 'required|string|max:255',
        ]);

        // Crear un nuevo empleado
        $employee = Employee::create($validated);

        return response()->json(['data' => new EmployeeResource($employee)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Mostrar detalles de un empleado específico
        $employee = Employee::findOrFail($id);
        return response()->json(['data' => new EmployeeResource($employee)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validar los datos de entrada
        $validated = $request->validate([
            'name' => 'string|max:255',
            'lastName' => 'string|max:255',
            'charge' => 'string|max:255',
            'salary' => 'numeric|min:0',
            'email' => 'email|unique:employees,email,' . $employee->id,
            'phone' => 'string|max:15',
            'schedule' => 'string|max:255',
        ]);

        // Actualizar los datos del empleado
        $employee->update($validated);

        return response()->json(['data' => new EmployeeResource($employee)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Eliminar el empleado
        $employee->delete();

        return response()->json(null, 200);
    }
}
