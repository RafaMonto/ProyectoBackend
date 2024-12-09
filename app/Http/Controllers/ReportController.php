<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Employee;
use App\Models\Dish;

class ReportController extends Controller
{
    //Informe de ventas, platos y personal

    public function salesReport(){
        $sales = Sale::all();

        $report = $sales->map(function($sale){
            return [
                'id' => $sale->id,
                'total' => $sale->total,
                'created_at' => $sale->created_at,
                'employee' => $sale->employee->name ?? 'Sin empleado',
                'dishes' => $sale->dishes
            ];
        });

        return response()->json(['data' => $report], 200);
    }

    public function employeeReport(){
        $employees = Employee::all();

        $report = $employees->map(function($employee){
            return [
                'id' => $employee->id,
                'name' => $employee->name,
                'lastName' => $employee->lastName,
                'charge' => $employee->charge,
                'salary' => $employee->salary,
                'email' => $employee->email,
                'phone' => $employee->phone,
                'schedule' => $employee->schedule
            ];
        });

        return response()->json(['data' => $report], 200);
    }

    public function dishesReport(){
        $dishes = Dish::all();

        $report = $dishes->map(function($dish){
            return [
                'id' => $dish->id,
                'name' => $dish->name,
                'description' => $dish->description,
                'price' => $dish->price,
                'availability' => $dish->availability ? 'Disponible' : 'No disponible',
                'category' => $dish->category->name ?? 'Sin categoria'
            ];
        });

        return response()->json(['data' => $report], 200);
    }
}
