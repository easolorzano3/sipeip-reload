@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📋 Metas</h2>

    <a href="{{ route('metas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
        ➕ Nueva Meta
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Objetivo Estratégico</th>
                <th class="border px-4 py-2">Meta</th>
                <th class="border px-4 py-2">Indicadores</th>
                <th class="border px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($metas as $index => $meta)
                <tr>
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $meta->objetivoEstrategico->nombre }}</td>
                    <td class="border px-4 py-2">{{ $meta->nombre }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('indicadores.index', $meta->id) }}" class="text-blue-600 underline">📊 Ver</a>
                    </td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <a href="{{ route('metas.edit', $meta->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">✏️ Editar</a>
                        <form action="{{ route('metas.destroy', $meta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">🗑️ Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
