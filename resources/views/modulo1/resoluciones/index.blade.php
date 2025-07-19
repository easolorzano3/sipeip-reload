@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📋 Resoluciones Publicadas</h2>

    {{-- Botón para crear nueva resolución --}}
    <a href="{{ route('resoluciones.create') }}"
       class="mb-4 inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        📤 Publicar nueva resolución
    </a>

    <table class="min-w-full bg-white border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4">#</th>
                <th class="py-2 px-4">N° Resolución</th>
                <th class="py-2 px-4">Fecha</th>
                <th class="py-2 px-4">Plan</th>
                <th class="py-2 px-4">Publicado por</th>
                <th class="py-2 px-4">Archivo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($resoluciones as $resolucion)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4">{{ $resolucion->numero }}</td>
                    <td class="py-2 px-4">{{ \Carbon\Carbon::parse($resolucion->fecha)->format('d/m/Y') }}</td>
                    <td class="py-2 px-4">{{ $resolucion->plan->nombre ?? 'Sin nombre' }}</td>
                    <td class="py-2 px-4">
                        {{ $resolucion->usuario->nombres ?? '' }} {{ $resolucion->usuario->apellidos ?? '' }}
                    </td>
                    <td class="py-2 px-4">
                        <a href="{{ asset('storage/' . $resolucion->archivo) }}" target="_blank"
                           class="text-blue-600 hover:underline">
                            📄 Ver PDF
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 py-4">
                        No se han publicado resoluciones aún. <br>
                        <a href="{{ route('resoluciones.create') }}" class="text-blue-600 hover:underline">
                            📤 Publicar una nueva resolución
                        </a>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
