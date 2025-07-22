@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📌 Detalles del Proyecto</h2>

    <div class="bg-white shadow-md rounded p-4 mb-6">
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

    {{-- Avances Financieros --}}
    <h3 class="text-lg font-semibold mb-2">💰 Avances Financieros</h3>
    <div class="overflow-x-auto mb-6">
        <table class="table-auto w-full text-sm border">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-3 py-2">Componente</th>
                    <th class="px-3 py-2">Valor</th>
                    <th class="px-3 py-2">Fecha</th>
                    <th class="px-3 py-2">Responsable</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyecto->avancesFinancieros as $avance)
                <tr class="border-t">
                    <td class="px-3 py-1">{{ $avance->componente }}</td>
                    <td class="px-3 py-1">${{ number_format($avance->valor_ejecutado, 2) }}</td>
                    <td class="px-3 py-1">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                    <td class="px-3 py-1">{{ $avance->usuario->nombres }} {{ $avance->usuario->apellidos }}</td>
                </tr>
                @empty
                <tr><td colspan="4" class="px-3 py-2 text-center text-gray-500">Sin registros</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Avances Físicos --}}
    <h3 class="text-lg font-semibold mb-2">📈 Avances Físicos</h3>
    <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm border">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-3 py-2">Fase</th>
                    <th class="px-3 py-2">Meta</th>
                    <th class="px-3 py-2">Avance (%)</th>
                    <th class="px-3 py-2">Fecha</th>
                    <th class="px-3 py-2">Responsable</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyecto->avancesFisicos as $avance)
                <tr class="border-t">
                    <td class="px-3 py-1">{{ $avance->fase }}</td>
                    <td class="px-3 py-1">{{ $avance->meta->nombre ?? '—' }}</td>
                    <td class="px-3 py-1">{{ $avance->porcentaje }}%</td>
                    <td class="px-3 py-1">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                    <td class="px-3 py-1">{{ $avance->usuario->nombres }} {{ $avance->usuario->apellidos }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-3 py-2 text-center text-gray-500">Sin registros</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
