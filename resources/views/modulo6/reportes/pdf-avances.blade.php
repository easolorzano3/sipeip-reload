<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Avances</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        h4 {
            margin-top: 30px;
            color: #34495e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 3px 0;
        }
    </style>
</head>
<body>

    <h2>📄 Reporte de Avances por Proyecto</h2>

    <div class="info">
        <p><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
        <p><strong>Rango:</strong> {{ $desde }} a {{ $hasta }}</p>
    </div>

    <h4>🛠️ Avances Físicos</h4>
    <table>
        <thead>
            <tr>
                <th>Fase</th>
                <th>Meta</th>
                <th>Avance (%)</th>
                <th>Fecha</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($avancesFisicos as $avance)
                <tr>
                    <td>{{ $avance->fase }}</td>
                    <td>{{ $avance->meta }}</td>
                    <td>{{ $avance->avance }}%</td>
                    <td>{{ $avance->fecha_corte }}</td>
                    <td>{{ $avance->usuario->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay avances físicos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4>💰 Avances Financieros</h4>
    <table>
        <thead>
            <tr>
                <th>Componente</th>
                <th>Valor Ejecutado</th>
                <th>Fecha de Corte</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($avancesFinancieros as $avance)
                <tr>
                    <td>{{ $avance->componente }}</td>
                    <td>$ {{ number_format($avance->valor_ejecutado, 2) }}</td>
                    <td>{{ $avance->fecha_corte }}</td>
                    <td>{{ $avance->usuario->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay avances financieros registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
