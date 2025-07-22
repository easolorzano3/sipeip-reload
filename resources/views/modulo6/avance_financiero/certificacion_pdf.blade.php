<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificación de Avance Financiero</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
    </style>
</head>
<body>
    <h2>Certificación de Avance Financiero</h2>

    <p><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
    <p><strong>Plan Institucional:</strong> {{ $proyecto->plan->nombre }}</p>
    <p><strong>Total Ejecutado:</strong> ${{ number_format($total_ejecutado, 2) }}</p>

    <table>
        <thead>
            <tr>
                <th>Componente</th>
                <th>Valor Ejecutado</th>
                <th>Fecha Corte</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avances as $avance)
            <tr>
                <td>{{ $avance->componente }}</td>
                <td>${{ number_format($avance->valor_ejecutado, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                <td>{{ $avance->usuario->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
