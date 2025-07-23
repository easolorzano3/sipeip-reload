@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">📄 Reportes Finales de Evaluación</h1>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <input type="text" name="nombre" class="form-input" placeholder="Nombre del proyecto" value="{{ request('nombre') }}">
        <input type="text" name="codigo" class="form-input" placeholder="Código" value="{{ request('codigo') }}">
        <select name="estado" class="form-select">
            <option value="">-- Estado --</option>
            <option value="finalizado" {{ request('estado') == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
            <option value="ejecucion" {{ request('estado') == 'ejecucion' ? 'selected' : '' }}>En ejecución</option>
        </select>
        <button class="btn btn-primary">Filtrar</button>
    </form>

    <table class="table-auto w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Plan</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $p)
                <tr>
                    <td class="px-4 py-2">{{ $p->codigo }}</td>
                    <td class="px-4 py-2">{{ $p->nombre }}</td>
                    <td class="px-4 py-2">{{ $p->plan->nombre ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $p->estado }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('modulo7.reportes.pdf', $p->id) }}" class="btn btn-sm btn-secondary">PDF</a>
                        <a href="{{ route('modulo7.reportes.excel', $p->id) }}" class="btn btn-sm btn-green-600">Excel</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center py-4">No se encontraron resultados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
