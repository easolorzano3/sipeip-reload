@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📘 Programas del Plan: {{ $plan->nombre }}</h2>

    <a href="{{ route('programas.create', ['plan_id' => $plan->id]) }}"
       class="bg-green-600 text-white px-4 py-2 rounded mb-6 inline-block">
        ➕ Crear Nuevo Programa
    </a>

    @if($plan->programas->isEmpty())
        <p class="text-gray-600">No hay programas registrados para este plan institucional.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($plan->programas as $programa)
                <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $programa->nombre }}</h3>
                    <p class="text-sm text-gray-600 mb-1"><strong>Descripción:</strong> {{ $programa->descripcion }}</p>
                    <p class="text-sm text-gray-600 mb-1"><strong>Sector:</strong> {{ $programa->sector }}</p>
                    <p class="text-sm text-gray-600 mb-4"><strong>Estado:</strong> {{ $programa->estado }}</p>

                    <div class="flex justify-between">
                        <a href="{{ route('programas.edit', $programa->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('programas.destroy', $programa->id) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar este programa?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>

                    {{-- Botón para ver proyectos --}}
                    <a href="{{ route('proyectos.indexPorPrograma', $programa->id) }}"
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm mt-4 block text-center">
                        📁 Ver Proyectos
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
