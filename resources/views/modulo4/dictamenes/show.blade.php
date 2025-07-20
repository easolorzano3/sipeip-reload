@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">🔍 Detalle del Dictamen Técnico</h2>

    <div class="bg-white shadow rounded-lg p-6 space-y-4">
        <div>
            <p class="text-sm text-gray-500 font-medium">Código:</p>
            <p class="text-lg font-semibold">{{ $dictamen->codigo_dictamen }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 font-medium">Proyecto Evaluado:</p>
            <p class="text-base">{{ $dictamen->proyecto->nombre ?? 'No disponible' }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500 font-medium">Plan Institucional:</p>
            <p class="text-base">{{ $dictamen->proyecto->plan->nombre ?? 'No definido' }}</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500 font-medium">Estado del Dictamen:</p>
                <span class="text-base font-semibold capitalize">
                    {{ $dictamen->estado_dictamen }}
                </span>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Prioridad:</p>
                <span class="text-base font-semibold capitalize">{{ $dictamen->prioridad }}</span>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Fecha de Dictamen:</p>
                <p class="text-base">{{ \Carbon\Carbon::parse($dictamen->fecha_dictamen)->format('d/m/Y') }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500 font-medium">Emitido por:</p>
                <p class="text-base">{{ $dictamen->usuario->name ?? 'Usuario desconocido' }}</p>
            </div>
        </div>

        <div>
            <p class="text-sm text-gray-500 font-medium">Justificación Técnica:</p>
            <p class="text-base whitespace-pre-line">{{ $dictamen->justificacion_tecnica }}</p>
        </div>

        @if($dictamen->evaluacion_financiera)
        <div>
            <p class="text-sm text-gray-500 font-medium">Evaluación Financiera:</p>
            <p class="text-base whitespace-pre-line">{{ $dictamen->evaluacion_financiera }}</p>
        </div>
        @endif

        @if($dictamen->recomendaciones)
        <div>
            <p class="text-sm text-gray-500 font-medium">Recomendaciones:</p>
            <p class="text-base whitespace-pre-line">{{ $dictamen->recomendaciones }}</p>
        </div>
        @endif

        <div class="pt-4">
            <a href="{{ route('dictamenes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow">
                ⬅️ Volver al listado
            </a>
        </div>
    </div>
</div>
@endsection
