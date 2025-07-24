@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6">📋 Planes Institucionales</h2>

    <a href="{{ route('planes.create') }}" class="mb-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
        + Crear nuevo plan
    </a>

    @if ($planes->isEmpty())
        <p class="text-gray-600">No hay planes registrados aún.</p>
    @else
        <table class="min-w-full bg-white shadow rounded mt-4">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Entidad</th>
                    <th class="px-4 py-2 text-left">Nivel</th>
                    <th class="px-4 py-2 text-left">Código Inst.</th>
                    <th class="px-4 py-2 text-left">Nombre del Plan</th>
                    <th class="px-4 py-2 text-left">Código Plan</th>
                    <th class="px-4 py-2 text-left">Periodo</th>
                    <th class="px-4 py-2 text-left">Estado Inst.</th>
                    <th class="px-4 py-2 text-left">Estado Plan</th>
                    <th class="px-4 py-2 text-left">Creado</th>
                    <th class="px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planes as $plan)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $plan->entidad }}</td>
                        <td class="px-4 py-2">{{ $plan->nivel_gobierno }}</td>
                        <td class="px-4 py-2">{{ $plan->codigo_institucional }}</td>
                        <td class="px-4 py-2">{{ $plan->nombre }}</td>
                        <td class="px-4 py-2">{{ $plan->codigo_plan }}</td>
                        <td class="px-4 py-2">{{ $plan->anio_inicio }} / {{ $plan->anio_fin }}</td>
                        <td class="px-4 py-2">{{ $plan->estado_institucional }}</td>
                        <td class="px-4 py-2 capitalize">{{ $plan->estado->nombre ?? 'Sin estado' }}</td>
                        <td class="px-4 py-2">{{ $plan->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('planes.show', $plan->id) }}" class="text-blue-600 hover:underline mr-2">Ver</a>
                            <a href="{{ route('planes.edit', $plan->id) }}" class="text-yellow-600 hover:underline mr-2">Editar</a>
                            <form action="{{ route('planes.destroy', $plan->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este plan?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-danger btn btn-link p-0 m-0 align-baseline">Eliminar</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    @endif
</div>
@endsection
