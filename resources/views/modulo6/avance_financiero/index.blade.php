@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold mb-4">📊 Avances Financieros</h2>

    {{-- Botón para nuevo avance --}}
    <div class="mb-4">
        <a href="{{ route('avance-financiero.create') }}"
           class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            ➕ Nuevo Avance Financiero
        </a>
    </div>

    {{-- Alerta de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 text-sm text-left">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="py-2 px-3 border">Proyecto</th>
                    <th class="py-2 px-3 border">Componente</th>
                    <th class="py-2 px-3 border">Valor Ejecutado</th>
                    <th class="py-2 px-3 border">Fecha Corte</th>
                    <th class="py-2 px-3 border">Responsable</th>
                    <th class="py-2 px-3 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($avances as $avance)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-3 border">{{ $avance->proyecto->nombre }}</td>
                    <td class="py-2 px-3 border">{{ $avance->componente }}</td>
                    <td class="py-2 px-3 border">${{ number_format($avance->valor_ejecutado, 2) }}</td>
                    <td class="py-2 px-3 border">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                    <td class="py-2 px-3 border">{{ $avance->usuario->nombres }} {{ $avance->usuario->apellidos }}</td>
                    <td class="py-2 px-3 border space-x-2">
                        {{-- Editar --}}
                        <a href="{{ route('avance-financiero.edit', $avance->id) }}"
                           class="inline-block bg-yellow-400 text-white px-2 py-1 rounded hover:bg-yellow-500">
                            ✏️ Editar
                        </a>

                        {{-- Certificación --}}
                        <a href="{{ route('modulo6.avance-financiero.certificacion', $avance->proyecto_id) }}"
                           class="inline-block bg-indigo-500 text-white px-2 py-1 rounded hover:bg-indigo-600">
                            📄 Certificación
                        </a>

                        {{-- Eliminar --}}
                        <form action="{{ route('avance-financiero.destroy', $avance->id) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('¿Deseas eliminar este avance?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($avances->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No hay avances financieros registrados.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
