@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📋 Detalle del Plan Institucional</h2>

    <div class="bg-white rounded shadow p-6">
        <p><strong>Entidad:</strong> {{ $plan->entidad }}</p>
        <p><strong>Nivel de Gobierno:</strong> {{ $plan->nivel_gobierno }}</p>
        <p><strong>Código Institucional:</strong> {{ $plan->codigo_institucional }}</p>
        <p><strong>Nombre del Plan:</strong> {{ $plan->nombre }}</p>
        <p><strong>Código del Plan:</strong> {{ $plan->codigo_plan }}</p>
        <p><strong>Periodo:</strong> {{ $plan->anio_inicio }} - {{ $plan->anio_fin }}</p>
        <p><strong>Estado Institucional:</strong> {{ $plan->estado_institucional }}</p>
        <p><strong>Estado Plan:</strong> {{ $plan->estado->nombre ?? 'Sin estado asignado' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('planes.index') }}" class="text-blue-500 hover:underline">← Volver al listado</a>
    </div>
</div>
@endsection
