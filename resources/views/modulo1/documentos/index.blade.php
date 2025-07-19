@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">📎 Documentos de Respaldo</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('documentos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4 inline-block">
        ➕ Nuevo Documento
    </a>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full table-auto border">
            <thead class="bg-gray-100 text-gray-700 text-left">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Plan</th>
                    <th class="px-4 py-2">Nombre</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Archivo</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $documento)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $documento->plan->nombre ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $documento->nombre_documento }}</td>
                    <td class="px-4 py-2">{{ $documento->tipo }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ asset('storage/' . $documento->archivo) }}" target="_blank" class="text-blue-600 underline">Ver</a>
                    </td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($documento->fecha_carga)->format('d/m/Y') }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ route('documentos.edit', $documento->id) }}" class="text-yellow-600 hover:underline">✏️ Editar</a>
                        <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('¿Estás seguro de eliminar este documento?')">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                @if ($documentos->isEmpty())
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">No hay documentos registrados.</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
