@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">✅ Test Dashboard - {{ $plan->nombre ?? 'sin nombre' }}</h2>

    <ul class="list-disc pl-6 space-y-1">
        <li>Total Proyectos: {{ $totalProyectos ?? '—' }}</li>
        <li>Finalizados: {{ $proyectosFinalizados ?? '—' }}</li>
        <li>En Ejecución: {{ $proyectosEnEjecucion ?? '—' }}</li>
        <li>Avance Financiero: {{ $avanceFinanciero ?? '—' }}%</li>
        <li>Total Usuarios: {{ $totalUsuarios ?? '—' }}</li>
        <li>Total Planes: {{ $planesTotales ?? '—' }}</li>
        <li>Planes Borrador: {{ $planesBorrador ?? '—' }}</li>
        <li>Planes Enviados: {{ $planesEnviados ?? '—' }}</li>
        <li>Planes Aprobados: {{ $planesAprobados ?? '—' }}</li>
        <li>Planes Publicados: {{ $planesPublicados ?? '—' }}</li>
        <li>Planes Finalizados: {{ $planesFinalizados ?? '—' }}</li>
    </ul>
</div>
@endsection