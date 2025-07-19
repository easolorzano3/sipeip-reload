@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📋 Planes Enviados para Revisión</h2>

    <table class="w-full table-auto border">
        <thead>
            <tr>
                <th class="px-4 py-2">#</th>
                <th class="px-4 py-2">Nombre del Plan</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planes as $plan)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $plan->id }}</td>
                <td class="px-4 py-2">{{ $plan->nombre }}</td>
                <td class="px-4 py-2">{{ $plan->estado->nombre ?? '-' }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('validaciones.edit', $plan->id) }}" class="text-blue-600">Validar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
