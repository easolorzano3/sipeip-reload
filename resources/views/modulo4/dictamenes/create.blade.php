@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">📝 Nuevo Dictamen Técnico</h2>

    <form action="{{ route('dictamenes.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Proyecto --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Proyecto evaluado <span class="text-red-500">*</span></label>
            <select name="proyecto_id" required class="form-select w-full border-gray-300 rounded shadow-sm">
                <option value="">-- Seleccione un proyecto --</option>
                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
            @error('proyecto_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fecha dictamen --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Fecha de dictamen <span class="text-red-500">*</span></label>
            <input type="date" name="fecha_dictamen" required class="w-full border-gray-300 rounded shadow-sm" value="{{ old('fecha_dictamen', date('Y-m-d')) }}">
            @error('fecha_dictamen')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Estado del dictamen --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Estado del dictamen <span class="text-red-500">*</span></label>
            <select name="estado_dictamen" required class="form-select w-full border-gray-300 rounded shadow-sm">
                <option value="">-- Seleccione un estado --</option>
                <option value="aprobado">✅ Aprobado</option>
                <option value="observado">⚠️ Observado</option>
                <option value="no_viable">❌ No viable</option>
            </select>
            @error('estado_dictamen')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prioridad --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Prioridad del proyecto <span class="text-red-500">*</span></label>
            <select name="prioridad" required class="form-select w-full border-gray-300 rounded shadow-sm">
                <option value="ninguna">Ninguna</option>
                <option value="alta">Alta</option>
                <option value="media">Media</option>
                <option value="baja">Baja</option>
            </select>
            @error('prioridad')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Justificación técnica --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Justificación técnica <span class="text-red-500">*</span></label>
            <textarea name="justificacion_tecnica" rows="4" required class="w-full border-gray-300 rounded shadow-sm">{{ old('justificacion_tecnica') }}</textarea>
            @error('justificacion_tecnica')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Evaluación financiera --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Evaluación financiera (opcional)</label>
            <textarea name="evaluacion_financiera" rows="3" class="w-full border-gray-300 rounded shadow-sm">{{ old('evaluacion_financiera') }}</textarea>
        </div>

        {{-- Recomendaciones --}}
        <div>
            <label class="block text-sm font-semibold mb-1">Recomendaciones (opcional)</label>
            <textarea name="recomendaciones" rows="3" class="w-full border-gray-300 rounded shadow-sm">{{ old('recomendaciones') }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between mt-6">
            <a href="{{ route('dictamenes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded shadow">⬅️ Cancelar</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow">
                💾 Guardar Dictamen
            </button>
        </div>
    </form>
</div>
@endsection
