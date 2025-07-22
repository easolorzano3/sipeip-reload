<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ejecución</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: left; }
        h2 { margin-top: 30px; }
    </style>
</head>
<body>

    <h1>Reporte de Ejecución del Proyecto</h1>
    <p><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
    <p><strong>Plan:</strong> {{ $proyecto->plan->nombre ?? 'N/D' }}</p>

    <h2>📂 Evidencias Documentales</h2>
    <table>
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Usuario</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyecto->documentosEvidencias as $doc)
                <tr>
                    <td>{{ $doc->tipo }}</td>
                    <td>{{ $doc->descripcion }}</td>
                    <td>{{ $doc->usuario->nombres ?? '—' }} {{ $doc->usuario->apellidos ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>📌 Hitos de Planificación Ejecutiva</h2>
    <table>
        <thead>
            <tr>
                <th>Hito</th>
                <th>Fecha</th>
                <th>Responsable</th>
                <th>Observación</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyecto->planificacionesEjecutivas as $hito)
                <tr>
                    <td>{{ $hito->hito }}</td>
                    <td>{{ \Carbon\Carbon::parse($hito->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $hito->responsable ?? '—' }}</td>
                    <td>{{ $hito->observacion ?? '—' }}</td>
                    <td>{{ $hito->usuario->nombres ?? '—' }} {{ $hito->usuario->apellidos ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
