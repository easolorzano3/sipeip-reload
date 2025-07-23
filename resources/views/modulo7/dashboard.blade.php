@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
    <h2 class="text-2xl font-bold mb-4">📋 Evaluación Final y Cierre - Planes Publicados</h2>

    @if($planes->isEmpty())
        <p class="text-gray-600">No se encontraron planes con los criterios especificados.</p>
    @else
        <table class="w-full table-auto text-sm border">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-2 border">Código</th>
                    <th class="p-2 border">Nombre</th>
                    <th class="p-2 border">Estado</th>
                    <th class="p-2 border text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planes as $plan)
                <tr>
                    <td class="border p-2">{{ $plan->codigo_plan }}</td>
                    <td class="border p-2">{{ $plan->nombre }}</td>
                    <td class="border p-2">{{ $plan->estado->nombre }}</td>
                    <td class="border p-2 text-center">
                        <a href="{{ route('modulo7.evaluacion.show', $plan->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                            Gestionar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <hr class="my-8">


    </div>
@endsection
