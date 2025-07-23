<div class="bg-white p-4 rounded shadow">
    <h3 class="text-xl font-bold mb-4 text-gray-700">📊 Evaluación Técnica y Financiera</h3>

    {{-- Sección: Metas e Indicadores --}}
    <h4 class="text-lg font-semibold mb-2 text-blue-700">🎯 Metas Planificadas con Indicadores</h4>
    <table class="w-full table-auto text-sm border mb-6">
        <thead class="bg-blue-100 text-gray-700">
            <tr>
                <th class="p-2 border">Meta</th>
                <th class="p-2 border">Descripción</th>
                <th class="p-2 border">Indicadores</th>
            </tr>
        </thead>
        <tbody>
            @forelse($metas as $meta)
                <tr>
                    <td class="border p-2 font-semibold">{{ $meta->nombre }}</td>
                    <td class="border p-2">{{ $meta->descripcion }}</td>
                    <td class="border p-2">
                        <ul class="list-disc pl-4">
                            @foreach($meta->indicadores as $indicador)
                                <li>{{ $indicador->nombre }} (meta: {{ $indicador->valor_meta }}, unidad: {{ $indicador->unidad }})</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-gray-500 p-4">No se encontraron metas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Sección: Avance Físico --}}
    <h4 class="text-lg font-semibold mb-2 text-green-700">📈 Avance Físico Registrado</h4>
    <table class="w-full table-auto text-sm border mb-6">
        <thead class="bg-green-100 text-gray-700">
            <tr>
                <th class="p-2 border">Fase</th>
                <th class="p-2 border">Meta vinculada</th>
                <th class="p-2 border">Porcentaje</th>
                <th class="p-2 border">Fecha de Corte</th>
            </tr>
        </thead>
        <tbody>
            @forelse($avancesFisicos as $avance)
                <tr>
                    <td class="border p-2">{{ $avance->fase }}</td>
                    <td class="border p-2">{{ optional($avance->meta)->nombre ?? 'Sin vincular' }}</td>
                    <td class="border p-2">{{ $avance->porcentaje }}%</td>
                    <td class="border p-2">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-gray-500 p-4">Sin registros de avance físico.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Sección: Avance Financiero --}}
    <h4 class="text-lg font-semibold mb-2 text-purple-700">💰 Avance Financiero Registrado</h4>
    <table class="w-full table-auto text-sm border">
        <thead class="bg-purple-100 text-gray-700">
            <tr>
                <th class="p-2 border">Componente</th>
                <th class="p-2 border">Valor Ejecutado</th>
                <th class="p-2 border">Fecha de Corte</th>
            </tr>
        </thead>
        <tbody>
            @forelse($avancesFinancieros as $avance)
                <tr>
                    <td class="border p-2">{{ $avance->componente }}</td>
                    <td class="border p-2">$ {{ number_format($avance->valor_ejecutado, 2) }}</td>
                    <td class="border p-2">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center text-gray-500 p-4">Sin registros financieros.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
