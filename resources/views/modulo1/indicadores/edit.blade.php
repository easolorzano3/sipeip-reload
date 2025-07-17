@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Editar Indicador</h2>

    {{-- Validación de errores --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario de edición --}}
    <form action="{{ route('indicadores.update', ['meta' => $meta_id, 'indicador' => $indicador->id]) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nombre del Indicador <span class="text-red-600">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre', $indicador->nombre) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Unidad --}}
            <div>
                <label class="block text-sm font-medium mb-1">Unidad de Medida</label>
                <input type="text" name="unidad" value="{{ old('unidad', $indicador->unidad) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Frecuencia --}}
            <div>
                <label class="block text-sm font-medium mb-1">Frecuencia</label>
                <input type="text" name="frecuencia" value="{{ old('frecuencia', $indicador->frecuencia) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Valor Referencia --}}
            <div>
                <label class="block text-sm font-medium mb-1">Valor de Referencia</label>
                <input type="number" name="valor_referencia" value="{{ old('valor_referencia', $indicador->valor_referencia) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Valor Meta --}}
            <div>
                <label class="block text-sm font-medium mb-1">Valor de la Meta</label>
                <input type="number" name="valor_meta" value="{{ old('valor_meta', $indicador->valor_meta) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Metodología --}}
        <div>
            <label class="block text-sm font-medium mb-1">Metodología</label>
            <textarea name="metodologia" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('metodologia', $indicador->metodologia) }}</textarea>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('descripcion', $indicador->descripcion) }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('indicadores.index', $meta_id) }}" class="text-blue-600 hover:underline">⬅️ Volver al listado</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                💾 Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
