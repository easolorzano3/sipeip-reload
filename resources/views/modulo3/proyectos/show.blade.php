@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">📋 Detalles del Proyecto</h2>

    <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
    <p><strong>Programa:</strong> {{ $proyecto->programa->nombre ?? '-' }}</p>
    <p><strong>Plan:</strong> {{ $proyecto->plan->nombre ?? '-' }}</p>
    <p><strong>Actividad POA:</strong> {{ $proyecto->actividad->nombre ?? '-' }}</p>
    <p><strong>Objetivo:</strong> {{ $proyecto->objetivo_general }}</p>
    <p><strong>Monto:</strong> $ {{ number_format($proyecto->monto_estimado, 2) }}</p>
    <p><strong>Cobertura:</strong> {{ $proyecto->cobertura }}</p>
    <p><strong>Desde:</strong> {{ $proyecto->cronograma_inicio }} / <strong>Hasta:</strong> {{ $proyecto->cronograma_fin }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($proyecto->estado) }}</p>
</div>
@endsection
