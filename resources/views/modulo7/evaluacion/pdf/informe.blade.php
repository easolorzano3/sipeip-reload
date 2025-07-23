<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Informe Proyecto</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h1 { font-size: 16px; }
    </style>
</head>
<body>
    <h1>Informe Final del Proyecto</h1>
    <p><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
    <p><strong>Plan:</strong> {{ $proyecto->plan->nombre }}</p>
    <p><strong>Generado en:</strong> {{ now()->format('d/m/Y H:i') }}</p>
</body>
</html>
