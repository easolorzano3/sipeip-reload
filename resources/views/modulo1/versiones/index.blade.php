@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-4">📄 Historial de Versiones del Plan</h2>

    <div class="mb-6">
        <form method="GET" action="{{ route('modulo1.versiones.index') }}" class="mb-4">

            <label for="plan_id" class="font-semibold">Seleccionar Plan:</label>
            <select name="plan_id" id="plan_id" onchange="this.form.submit()" class="border rounded px-2 py-1 ml-2">
                @foreach ($todosLosPlanes as $p)
                    <option value="{{ $p->id }}" {{ $p->id == $plan->id ? 'selected' : '' }}>
                        {{ $p->nombre }}
                    </option>
                @endforeach
            </select>
        </form>

        <p><strong>Plan:</strong> {{ $plan->nombre }}</p>
        <a href="{{ route('versiones.generar-pdf', $plan->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow inline-block">
            📥 Descargar Reporte Técnico (PDF)
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-4 overflow-x-auto">
        <table class="w-full table-auto text-left">
            <thead>
                <tr class="bg-gray-100 text-sm">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Acción</th>
                    <th class="px-4 py-2">Descripción</th>
                    <th class="px-4 py-2">Usuario</th>
                    <th class="px-4 py-2">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($versiones as $i => $item)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                        <td class="px-4 py-2">{{ $item->accion }}</td>
                        <td class="px-4 py-2">{{ $item->descripcion ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $item->usuario->nombre_completo ?? 'Usuario no disponible' }}</td>
                        <td class="px-4 py-2">{{ date('d/m/Y H:i', strtotime($item->fecha_accion)) }}</td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">No hay registros aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
