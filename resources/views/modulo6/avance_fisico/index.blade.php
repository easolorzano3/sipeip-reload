@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📊 Avances Físicos</h2>

    <a href="{{ route('avance-fisico.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
        ➕ Nuevo avance físico
    </a>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded shadow">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">Proyecto</th>
                    <th class="px-4 py-2 border-b">Fase</th>
                    <th class="px-4 py-2 border-b">Meta</th>
                    <th class="px-4 py-2 border-b">Avance (%)</th>
                    <th class="px-4 py-2 border-b">Fecha Corte</th>
                    <th class="px-4 py-2 border-b">Responsable</th>
                    <th class="px-4 py-2 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($avances as $avance)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $avance->proyecto->nombre ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $avance->fase ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $avance->meta->nombre ?? '—' }}</td>
                        <td class="px-4 py-2">{{ $avance->porcentaje ?? 0 }}%</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($avance->fecha_corte)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">{{ $avance->usuario->nombres ?? '—' }} {{ $avance->usuario->apellidos ?? '' }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('avance-fisico.edit', $avance->id) }}" class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 text-sm">
                                ✏️ Editar
                            </a>
                            <form action="{{ route('avance-fisico.destroy', $avance->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este avance físico?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 px-4 py-4">No hay avances físicos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
