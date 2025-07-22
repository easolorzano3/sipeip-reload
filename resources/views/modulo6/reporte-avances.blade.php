@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📊 Reporte de Avances por Proyecto</h2>

    <form method="GET" action="{{ route('modulo6.reporte-avances') }}" class="bg-white p-4 rounded shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="font-semibold">Proyecto:</label>
                <select name="proyecto_id" class="form-select w-full" required>
                    <option value="">-- Selecciona un proyecto --</option>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ request('proyecto_id') == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="font-semibold">Desde:</label>
                <input type="date" name="fecha_inicio" class="form-input w-full" value="{{ request('fecha_inicio') }}" required>
            </div>
            <div>
                <label class="font-semibold">Hasta:</label>
                <input type="date" name="fecha_fin" class="form-input w-full" value="{{ request('fecha_fin') }}" required>
            </div>
        </div>
        <div class="mt-4">
            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">🔍 Consultar</button>
        </div>
    </form>

    @if($avancesFisicos->count() || $avancesFinancieros->count())
        <div class="bg-white p-4 rounded shadow mb-6">
            <h3 class="text-lg font-semibold mb-2">📌 Avances Físicos</h3>
            <table class="table-auto w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Fase</th>
                        <th class="px-4 py-2">Meta</th>
                        <th class="px-4 py-2">Avance (%)</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($avancesFisicos as $a)
                        <tr>
                            <td class="border px-4 py-2">{{ $a->fase }}</td>
                            <td class="border px-4 py-2">{{ $a->meta->nombre ?? '-' }}</td>
                            <td class="border px-4 py-2">{{ number_format($a->porcentaje, 2) }}%</td>
                            <td class="border px-4 py-2">{{ $a->fecha_corte }}</td>
                            <td class="border px-4 py-2">{{ $a->usuario->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-2">Sin registros.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">💰 Avances Financieros</h3>
            <table class="table-auto w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Componente</th>
                        <th class="px-4 py-2">Valor</th>
                        <th class="px-4 py-2">Fecha</th>
                        <th class="px-4 py-2">Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($avancesFinancieros as $f)
                        <tr>
                            <td class="border px-4 py-2">{{ $f->componente }}</td>
                            <td class="border px-4 py-2">$ {{ number_format($f->valor, 2) }}</td>
                            <td class="border px-4 py-2">{{ $f->fecha }}</td>
                            <td class="border px-4 py-2">{{ $f->usuario->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-2">Sin registros.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
