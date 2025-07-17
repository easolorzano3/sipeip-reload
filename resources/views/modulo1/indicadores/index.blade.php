@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📊 Indicadores por Meta</h2>

    {{-- Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Botón para crear nuevo indicador --}}
    <div class="mb-4">
        <a href="{{ route('indicadores.create', $meta->id) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ➕ Registrar Indicador
        </a>
    </div>

    {{-- Tabla de indicadores --}}
    @if($meta->indicadores->count())
        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead class="bg-gray-100 text-left text-sm uppercase">
                <tr>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Unidad</th>
                    <th class="px-4 py-2">Frecuencia</th>
                    <th class="px-4 py-2">Valor Referencia</th>
                    <th class="px-4 py-2">Valor Meta</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($meta->indicadores as $indicador)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $indicador->nombre }}</td>
                        <td class="px-4 py-2">{{ $indicador->unidad ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $indicador->frecuencia ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $indicador->valor_referencia ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $indicador->valor_meta ?? '—' }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('indicadores.edit', ['meta' => $meta->id, 'indicador' => $indicador->id]) }}"
                               class="text-blue-600 hover:underline">✏️ Editar</a>
                            <form action="{{ route('indicadores.destroy', ['meta' => $meta->id, 'indicador' => $indicador->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este indicador?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑️ Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-600">No hay indicadores registrados para esta meta.</p>
    @endif
</div>
@endsection
