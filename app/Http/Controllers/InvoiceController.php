<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Sale;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sendInvoice(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'email' => 'required|email',
        ]);

        $invoice = Invoice::with('sale')->findOrFail($request->invoice_id);

        // Genera el PDF
        $pdf = PDF::loadView('emails.invoice-pdf', ['invoice' => $invoice]);

        // Enviar el correo
        Mail::send('emails.invoice', ['invoice' => $invoice], function ($message) use ($request, $pdf) {
            $message->to($request->email)
                    ->subject('Factura de Compra')
                    ->attachData($pdf->output(), 'invoice.pdf');
        });

        return response()->json(['message' => 'Correo enviado correctamente.']);
    }

    public function index(Request $request)
    {
        // Return all invoices with sorting
        $sort = $request->input('sort', 'created_at_exact'); // Default sorting field
        $type = $request->input('type', 'asc'); // Default sorting type

        $validType = ['asc', 'desc']; // Valid sorting types

        if (!in_array($type, $validType, true)) {
            $message = "Invalid sort type: $type";

            return response()->json(['data' => $message], 400);
        }

        $validSort = ['created_at_exact', 'total', 'clientName', 'sale_id']; // Valid sorting fields

        if (!in_array($sort, $validSort, true)) {
            $message = "Invalid sort field: $sort";

            return response()->json(['data' => $message], 400);
        }

        $invoices = Invoice::orderBy($sort, $type)->get();

        return response()->json(['data' => $invoices], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'total' => 'required|string',
            'clientName' => 'required|string|max:255',
        ]);

        // Create the invoice
        $invoice = Invoice::create([
            'sale_id' => $validated['sale_id'],
            'total' => $validated['total'],
            'clientName' => $validated['clientName'],
        ]);

        return response()->json(['data' => $invoice], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Return a specific invoice
        $invoice = Invoice::findOrFail($id);
        return response()->json(['data' => $invoice], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        // Validate the input data
        $validated = $request->validate([
            'sale_id' => 'sometimes|exists:sales,id',
            'total' => 'sometimes|string',
            'clientName' => 'sometimes|string|max:255',
        ]);

        // Update the invoice
        $invoice->update($validated);

        return response()->json(['data' => $invoice], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        // Delete the invoice
        $invoice->delete();

        return response()->json(null, 204);
    }
}
