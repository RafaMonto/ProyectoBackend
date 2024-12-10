<h1>Factura</h1>
<p><strong>Cliente:</strong> {{ $invoice->clientName }}</p>
<p><strong>Total:</strong> {{ $invoice->total }}</p>
<p><strong>Fecha:</strong> {{ $invoice->created_at_exact }}</p>
<hr>
<h2>Detalles de la Venta</h2>
<p><strong>Total de Venta:</strong> {{ $invoice->sale->total }}</p>
<p><strong>Platos:</strong> {{ $invoice->sale->dishes }}</p>
