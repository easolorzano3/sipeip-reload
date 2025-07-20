@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">📋 Listado de Dictámenes Técnicos</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('dictamenes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
            ➕ Nuevo Dictamen
        </a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Código</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Proyecto</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Estado</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Prioridad</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Fecha</th>
                    <th class="px-4 py-3 text-left font-semibold text-gray-700">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($dictamenes as $dictamen)
                    <tr>
                        <td class="px-4 py-2">{{ $dictamen->codigo_dictamen }}</td>
                        <td class="px-4 py-2">
                            {{ $dictamen->proyecto->plan->nombre ?? 'No definido' }}
                        </td>
                        <td class="px-4 py-2">
                            @php
                                $estadoColor = match($dictamen->estado_dictamen) {
                                    'aprobado' => 'bg-green-100 text-green-700',
                                    'observado' => 'bg-yellow-100 text-yellow-700',
                                    'no_viable' => 'bg-red-100 text-red-700',
                                    default => ''
                                };
                            @endphp
                            <span class="px-2 py-1 rounded text-xs font-medium {{ $estadoColor }}">
                                {{ ucfirst($dictamen->estado_dictamen) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 capitalize">{{ $dictamen->prioridad }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($dictamen->fecha_dictamen)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 space-x-1">
                            <a href="{{ route('dictamenes.show', $dictamen->id) }}" class="text-blue-600 hover:text-blue-800">🔍</a>
                            <a href="{{ route('dictamenes.edit', $dictamen->id) }}" class="text-yellow-600 hover:text-yellow-800">✏️</a>
                            <form action="{{ route('dictamenes.destroy', $dictamen->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este dictamen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">🗑️</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No hay dictámenes registrados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
