<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Historial - {{ $plan->nombre }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #000;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin-bottom: 5px;
        }
        .info {
            margin-bottom: 15px;
        }
        .info strong {
            display: inline-block;
            width: 130px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #888;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #e4e4e4;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reporte Técnico de Versiones e Historial</h2>
        <p><strong>Módulo 1:</strong> Planificación Institucional</p>
    </div>

    <div class="info">
        <p><strong>Nombre del Plan:</strong> {{ $plan->nombre }}</p>
        <p><strong>Fecha de generación:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Acción</th>
                <th>Descripción</th>
                <th>Usuario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($versiones as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->accion }}</td>
                    <td>{{ $item->descripcion ?? '-' }}</td>
                    <td>{{ $item->usuario->nombre_completo ?? 'N/D' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->fecha_accion)->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
