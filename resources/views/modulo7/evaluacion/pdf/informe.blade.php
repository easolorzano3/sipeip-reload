<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe Final del Proyecto</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        h1, h2, h3 { color: #333; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Informe Final del Proyecto</h1>

    <div class="section">
        <strong>Nombre del plan:</strong> {{ $plan->nombre }}<br>
        <strong>Código:</strong> {{ $plan->codigo }}
    </div>

    <div class="section">
        <h3>Metas e Indicadores</h3>
        @foreach ($proyecto->metas as $meta)
            <p><strong>Meta:</strong> {{ $meta->nombre }}</p>
            <p>Descripción: {{ $meta->descripcion }}</p>
            @if ($meta->indicadores)
                <ul>
                    @foreach ($meta->indicadores as $indicador)
                        <li>
                            Indicador: {{ $indicador->nombre }} |
                            Meta: {{ $indicador->meta }} |
                            Unidad: {{ $indicador->unidad_medida }}
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </div>

    <div class="section">
        <h3>Lecciones Aprendidas</h3>
        @foreach ($proyecto->lecciones as $leccion)
            <p>📝 {{ $leccion->contenido }}</p>
        @endforeach
    </div>
</body>
</html>
