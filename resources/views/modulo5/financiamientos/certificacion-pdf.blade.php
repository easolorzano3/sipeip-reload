<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Certificación Presupuestaria</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000;
        }
        h2 {
            text-align: center;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .mt-3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>📄 Certificación Presupuestaria</h2>

    <p><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
    <p><strong>Código:</strong> {{ $proyecto->codigo }}</p>
    <p><strong>Plan:</strong> {{ $proyecto->plan->nombre ?? '---' }}</p>

    <h3 class="mt-3">Fuentes de Financiamiento</h3>
    <table>
        <thead>
            <tr>
                <th>Fuente</th>
                <th>Año</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($financiamientos as $f)
                <tr>
                    <td>{{ $f->fuente->nombre }}</td>
                    <td>{{ $f->anio }}</td>
                    <td>${{ number_format($f->monto, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2"><strong>Total Asignado:</strong></td>
                <td><strong>${{ number_format($totalAsignado, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <h3 class="mt-3">Techo Plurianual</h3>
    <table>
        <thead>
            <tr>
                <th>Año</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($techos as $t)
                <tr>
                    <td>{{ $t->anio }}</td>
                    <td>${{ number_format($t->monto, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
