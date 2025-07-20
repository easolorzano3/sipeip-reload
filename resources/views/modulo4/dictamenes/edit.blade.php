@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">✏️ Editar Dictamen Técnico</h2>

    <form action="{{ route('dictamenes.update', $dictamen->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Proyecto (solo lectura) --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Proyecto evaluado</label>
            <input type="text" readonly disabled class="w-full bg-gray-100 border-gray-300 rounded shadow-sm"
                value="{{ $dictamen->proyecto->nombre ?? 'No disponible' }}">
        </div>

        {{-- Plan institucional (solo lectura) --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Plan Institucional</label>
            <input type="text" readonly disabled class="w-full bg-gray-100 border-gray-300 rounded shadow-sm"
                value="{{ $dictamen->proyecto->plan->nombre ?? 'No definido' }}">
        </div>

        {{-- Fecha dictamen --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Fecha de dictamen <span class="text-red-500">*</span></label>
            <input type="date" name="fecha_dictamen" required class="w-full border-gray-300 rounded shadow-sm"
                value="{{ old('fecha_dictamen', $dictamen->fecha_dictamen) }}">
            @error('fecha_dictamen')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Estado del dictamen --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Estado del dictamen <span class="text-red-500">*</span></label>
            <select name="estado_dictamen" required class="form-select w-full border-gray-300 rounded shadow-sm">
                <option value="aprobado" {{ $dictamen->estado_dictamen == 'aprobado' ? 'selected' : '' }}>✅ Aprobado</option>
                <option value="observado" {{ $dictamen->estado_dictamen == 'observado' ? 'selected' : '' }}>⚠️ Observado</option>
                <option value="no_viable" {{ $dictamen->estado_dictamen == 'no_viable' ? 'selected' : '' }}>❌ No viable</option>
            </select>
            @error('estado_dictamen')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prioridad --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Prioridad del proyecto <span class="text-red-500">*</span></label>
            <select name="prioridad" required class="form-select w-full border-gray-300 rounded shadow-sm">
                <option value="ninguna" {{ $dictamen->prioridad == 'ninguna' ? 'selected' : '' }}>Ninguna</option>
                <option value="alta" {{ $dictamen->prioridad == 'alta' ? 'selected' : '' }}>Alta</option>
                <option value="media" {{ $dictamen->prioridad == 'media' ? 'selected' : '' }}>Media</option>
                <option value="baja" {{ $dictamen->prioridad == 'baja' ? 'selected' : '' }}>Baja</option>
            </select>
            @error('prioridad')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Justificación técnica --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Justificación técnica <span class="text-red-500">*</span></label>
            <textarea name="justificacion_tecnica" rows="4" required class="w-full border-gray-300 rounded shadow-sm">{{ old('justificacion_tecnica', $dictamen->justificacion_tecnica) }}</textarea>
            @error('justificacion_tecnica')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Evaluación financiera --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Evaluación financiera (opcional)</label>
            <textarea name="evaluacion_financiera" rows="3" class="w-full border-gray-300 rounded shadow-sm">{{ old('evaluacion_financiera', $dictamen->evaluacion_financiera) }}</textarea>
        </div>

        {{-- Recomendaciones --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Recomendaciones (opcional)</label>
            <textarea name="recomendaciones" rows="3" class="w-full border-gray-300 rounded shadow-sm">{{ old('recomendaciones', $dictamen->recomendaciones) }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('dictamenes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow">⬅️ Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow">
                💾 Actualizar Dictamen
            </button>
        </div>
    </form>
</div>
@endsection
