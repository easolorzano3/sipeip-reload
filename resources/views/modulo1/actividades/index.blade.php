@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">📋 Actividades POA</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('actividades.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            ➕ Nueva Actividad
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm text-left border">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nombre</th>
                    <th class="px-4 py-2 border">Meta</th>
                    <th class="px-4 py-2 border">Responsable</th>
                    <th class="px-4 py-2 border">Fecha</th>
                    <th class="px-4 py-2 border">Presupuesto</th>
                    <th class="px-4 py-2 border text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($actividades as $actividad)
                    <tr class="border-b">
                        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2 border">{{ $actividad->nombre }}</td>
                        <td class="px-4 py-2 border">{{ $actividad->meta->nombre ?? '-' }}</td>
                        <td class="px-4 py-2 border">
                            {{ $actividad->responsable?->nombres }} {{ $actividad->responsable?->apellidos }}
                        </td>

                        <td class="px-4 py-2 border">
                            {{ \Carbon\Carbon::parse($actividad->fecha_inicio)->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($actividad->fecha_fin)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-2 border">${{ number_format($actividad->presupuesto_estimado, 2) }}</td>
                        <td class="px-4 py-2 border text-center space-x-2">
                            <a href="{{ route('actividades.edit', $actividad->id) }}" class="text-blue-600 hover:underline">✏️ Editar</a>
                            <form action="{{ route('actividades.destroy', $actividad->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta actividad?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">🗑 Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-500">No hay actividades registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
