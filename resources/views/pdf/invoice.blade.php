<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
</head>
<body>
    <h1>Factura #{{ $invoice->id }}</h1>
    <p>Cliente: {{ $invoice->clientName }}</p>
    <p>Total: ${{ $invoice->total }}</p>
    <p>Fecha: {{ $invoice->created_at_exact }}</p>
    <hr>
    <h2>Venta asociada</h2>
    <p>Total: ${{ $invoice->sale->total }}</p>
    <p>Platos: {{ $invoice->sale->dishes }}</p>
</body>
</html>