@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">📤 Envío a Revisión</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('revision.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
        ➕ Nuevo Envío
    </a>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full table-auto border text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Plan</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Fecha Envío</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($envios as $envio)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $envio->plan->nombre ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $envio->estado_envio }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($envio->fecha_envio)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        
                        <form action="{{ route('revision.destroy', $envio->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este envío?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">🗑 Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($envios->isEmpty())
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">No hay registros.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
