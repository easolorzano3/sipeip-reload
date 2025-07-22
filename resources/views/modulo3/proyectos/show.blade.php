@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📋 Detalles del Proyecto</h2>

    <div class="bg-white rounded shadow p-4 mb-6">
        <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
        <p><strong>Programa:</strong> {{ $proyecto->programa->nombre ?? '-' }}</p>
        <p><strong>Plan:</strong> {{ $proyecto->plan->nombre ?? '-' }}</p>
        <p><strong>Actividad POA:</strong> {{ $proyecto->actividad->nombre ?? '-' }}</p>
        <p><strong>Objetivo:</strong> {{ $proyecto->objetivo_general }}</p>
        <p><strong>Monto:</strong> ${{ number_format($proyecto->monto_estimado, 2) }}</p>
        <p><strong>Cobertura:</strong> {{ $proyecto->cobertura }}</p>
        <p><strong>Desde:</strong> {{ $proyecto->cronograma_inicio }} <strong>Hasta:</strong> {{ $proyecto->cronograma_fin }}</p>
        <p><strong>Estado:</strong> {{ ucfirst($proyecto->estado) }}</p>
    </div>

    <!-- BLOQUE DE AVANCES FINANCIEROS -->
    <h3 class="text-lg font-semibold mb-2">💰 Avances Financieros</h3>
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead class="bg-gray-100 text-sm text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Componente</th>
                    <th class="px-4 py-2 text-left">Valor Ejecutado</th>
                    <th class="px-4 py-2 text-left">Fecha Corte</th>
                    <th class="px-4 py-2 text-left">Responsable</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($proyecto->avancesFinancieros as $avance)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $avance->componente }}</td>
                    <td class="px-4 py-2">${{ number_format($avance->valor_ejecutado, 2) }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $avance->usuario->nombres ?? '—' }} {{ $avance->usuario->apellidos ?? '' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">No hay avances financieros registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- BLOQUE DE AVANCES FÍSICOS -->
    <h3 class="text-lg font-semibold mb-2">📈 Avances Físicos</h3>
    <div class="overflow-x-auto mb-6">
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead class="bg-gray-100 text-sm text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Fase</th>
                    <th class="px-4 py-2 text-left">Meta</th>
                    <th class="px-4 py-2 text-left">Avance (%)</th>
                    <th class="px-4 py-2 text-left">Fecha Corte</th>
                    <th class="px-4 py-2 text-left">Responsable</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($proyecto->avancesFisicos as $avance)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $avance->fase }}</td>
                    <td class="px-4 py-2">{{ $avance->meta->nombre ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $avance->porcentaje }}%</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">{{ $avance->usuario->nombres ?? '—' }} {{ $avance->usuario->apellidos ?? '' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">No hay avances físicos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
