<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
     * Enviar la factura como PDF por correo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendInvoice(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'invoice_id' => 'required|exists:invoices,id',
        ]);

        $invoice = Invoice::with('sale')->find($request->invoice_id);

        // Genera el PDF con los datos de la factura
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('pdf.invoice', ['invoice' => $invoice]);

        // Envía el correo
        Mail::send([], [], function ($message) use ($request, $pdf, $invoice) {
            $message->to($request->email)
                ->subject("Factura #{$invoice->id}")
                ->attachData($pdf->output(), "Factura_{$invoice->id}.pdf", [
                    'mime' => 'application/pdf',
                ])
                ->setBody("Hola, adjunto encontrarás la factura #{$invoice->id}.");
        });

        return response()->json(['message' => 'Factura enviada exitosamente.']);
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
