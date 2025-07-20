@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📂 Proyectos del Programa: {{ $programa->nombre }}</h2>

    <a href="{{ route('proyectos.create', ['programa_id' => $programa->id]) }}"
       class="bg-green-600 text-white px-4 py-2 rounded mb-6 inline-block">
        ➕ Crear Nuevo Proyecto
    </a>

    @if($programa->proyectos->isEmpty())
        <p class="text-gray-600">No hay proyectos registrados para este programa.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
            @foreach($programa->proyectos as $proyecto)
                <div class="bg-white shadow rounded-lg p-4 border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $proyecto->nombre }}</h3>
                    <p class="text-sm text-gray-600 mb-1"><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
                    <p class="text-sm text-gray-600 mb-1"><strong>Estado:</strong> {{ $proyecto->estado }}</p>

                    <div class="flex justify-between mt-2">
                        <a href="{{ route('proyectos.edit', $proyecto->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST"
                              onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
