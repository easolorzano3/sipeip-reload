@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">🆕 Nuevo Proyecto</h2>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>¡Ups! Hubo algunos errores al guardar el proyecto:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf

        {{-- Plan y Programa --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Plan Institucional</label>
                <input type="text" class="form-input w-full" value="{{ $plan->nombre }}" readonly>
                <input type="hidden" name="plan_id" value="{{ $plan->id }}">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Programa</label>
                <input type="text" class="form-input w-full" value="{{ $programa->nombre }}" readonly>
                <input type="hidden" name="programa_id" value="{{ $programa->id }}">
            </div>
        </div>

        {{-- Nombre del Proyecto --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nombre del Proyecto</label>
            <input type="text" name="nombre" class="form-input w-full" required>
        </div>

        {{-- Actividad del POA y Código --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Actividad del POA (opcional)</label>
                <select name="actividad_poa_id" class="form-select w-full">
                    <option value="">-- Sin vínculo directo --</option>
                    @foreach ($actividades as $actividad)
                        <option value="{{ $actividad->id }}">{{ $actividad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Código del Proyecto</label>
                <input type="text" name="codigo" class="form-input w-full" value="{{ $codigoGenerado }}" required>
            </div>
        </div>

        {{-- Objetivo y Monto --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Objetivo General</label>
            <textarea name="objetivo_general" rows="3" class="form-textarea w-full" required></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Monto Estimado ($)</label>
                <input type="number" name="monto_estimado" step="0.01" class="form-input w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Cobertura</label>
                <input type="text" name="cobertura" class="form-input w-full" placeholder="Ej. Zona rural del cantón Milagro" required>
            </div>
        </div>

        {{-- Fechas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Inicio</label>
                <input type="date" name="cronograma_inicio" class="form-input w-full" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fin</label>
                <input type="date" name="cronograma_fin" class="form-input w-full" required>
            </div>
        </div>

        {{-- Botón --}}
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            💾 Guardar Proyecto
        </button>
    </form>
</div>
@endsection
