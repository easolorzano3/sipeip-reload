@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📋 Alineaciones PND / ODS</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('alineaciones-pnd-ods.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            ➕ Nueva Alineación
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-700 text-sm uppercase text-left">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Objetivo Estratégico</th>
                    <th class="px-4 py-2">PND</th>
                    <th class="px-4 py-2">ODS</th>
                    <th class="px-4 py-2">Indicador</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($alineaciones as $index => $alineacion)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $alineacion->objetivoEstrategico->nombre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $alineacion->pnd->nombre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $alineacion->ods->nombre ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $alineacion->indicador }}</td>
                        <td class="px-4 py-2 flex space-x-2">
                            <a href="{{ route('alineaciones-pnd-ods.edit', $alineacion->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">✏️ Editar</a>

                            <form action="{{ route('alineaciones-pnd-ods.destroy', $alineacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta alineación?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                @if($alineaciones->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">No hay registros.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
