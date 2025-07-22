@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📊 Reporte de Ejecución del Proyecto</h2>

    {{-- Datos Generales --}}
    <div class="bg-white rounded shadow p-4 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-2">🧾 Datos Generales</h3>
        <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
        <p><strong>Código:</strong> {{ $proyecto->codigo }}</p>
        <p><strong>Fecha Inicio:</strong> {{ $proyecto->fecha_inicio ?? '—' }}</p>
        <p><strong>Fecha Fin:</strong> {{ $proyecto->fecha_fin ?? '—' }}</p>
        <p><strong>Plan Asociado:</strong> {{ $proyecto->plan->nombre ?? '—' }}</p>
    </div>

    {{-- Evidencias Documentales --}}
    @if($proyecto->documentosEvidencias->isNotEmpty())
        <div class="bg-white rounded shadow p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">📂 Evidencias Documentales</h3>
            <table class="w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border">Tipo</th>
                        <th class="px-3 py-2 border">Descripción</th>
                        <th class="px-3 py-2 border">Usuario</th>
                        <th class="px-3 py-2 border">Fecha</th>
                        <th class="px-3 py-2 border">Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyecto->documentosEvidencias as $doc)
                        <tr>
                            <td class="px-3 py-2 border">{{ $doc->tipo }}</td>
                            <td class="px-3 py-2 border">{{ $doc->descripcion ?? '—' }}</td>
                            <td class="px-3 py-2 border">{{ $doc->usuario->nombres ?? '—' }} {{ $doc->usuario->apellidos ?? '' }}</td>
                            <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($doc->created_at)->format('d/m/Y') }}</td>
                            <td class="px-3 py-2 border">
                                <a href="{{ asset('storage/evidencias/'.$doc->archivo) }}" target="_blank" class="text-indigo-600 hover:underline">Ver</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Hitos Planificados --}}
    @if($proyecto->planificacionesEjecutivas->isNotEmpty())
        <div class="bg-white rounded shadow p-4 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">📌 Hitos Planificados</h3>
            <table class="w-full table-auto border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 border">Hito</th>
                        <th class="px-3 py-2 border">Fecha</th>
                        <th class="px-3 py-2 border">Responsable</th>
                        <th class="px-3 py-2 border">Observación</th>
                        <th class="px-3 py-2 border">Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyecto->planificacionesEjecutivas as $item)
                        <tr>
                            <td class="px-3 py-2 border">{{ $item->hito }}</td>
                            <td class="px-3 py-2 border">{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                            <td class="px-3 py-2 border">{{ $item->responsable ?? '—' }}</td>
                            <td class="px-3 py-2 border">{{ $item->observacion ?? '—' }}</td>
                            <td class="px-3 py-2 border">{{ $item->usuario->nombres ?? '—' }} {{ $item->usuario->apellidos ?? '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Acciones --}}
    <div class="flex justify-between items-center mt-6">
        <a href="{{ route('modulo6.index') }}" class="text-indigo-600 hover:underline text-sm">← Volver al módulo</a>

        <a href="{{ route('modulo6.reporte.pdf', $proyecto->id) }}"
           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-semibold shadow">
            🧾 Generar PDF del Reporte
        </a>
    </div>
</div>
@endsection
