@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">📋 Detalles del Programa</h2>

    <p><strong>Nombre:</strong> {{ $programa->nombre }}</p>
    <p><strong>Plan:</strong> {{ $programa->plan->nombre ?? '-' }}</p>
    <p><strong>Sector:</strong> {{ $programa->sector }}</p>
    <p><strong>Descripción:</strong> {{ $programa->descripcion }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($programa->estado) }}</p>
</div>
@endsection
