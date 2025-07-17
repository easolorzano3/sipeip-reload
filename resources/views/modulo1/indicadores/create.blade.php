@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">➕ Registrar Indicador</h2>

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

    {{-- Formulario --}}
    <form action="{{ route('indicadores.store', $meta->id) }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="meta_id" value="{{ $meta->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nombre --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nombre del Indicador <span class="text-red-600">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre') }}" required
                    placeholder="Ej: Porcentaje de cumplimiento..."
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Unidad de Medida --}}
            <div>
                <label class="block text-sm font-medium mb-1">Unidad de Medida</label>
                <input type="text" name="unidad" value="{{ old('unidad') }}"
                    placeholder="Ej: Porcentaje, Número, Ratio..."
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Frecuencia --}}
            <div>
                <label class="block text-sm font-medium mb-1">Frecuencia</label>
                <input type="text" name="frecuencia" value="{{ old('frecuencia') }}"
                    placeholder="Ej: Trimestral, Anual..."
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Valor de Referencia --}}
            <div>
                <label class="block text-sm font-medium mb-1">Valor de Referencia</label>
                <input type="number" name="valor_referencia" value="{{ old('valor_referencia') }}"
                    placeholder="Ej: 25"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>

            {{-- Valor de la Meta --}}
            <div>
                <label class="block text-sm font-medium mb-1">Valor de la Meta</label>
                <input type="number" name="valor_meta" value="{{ old('valor_meta') }}"
                    placeholder="Ej: 70"
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Metodología --}}
        <div>
            <label class="block text-sm font-medium mb-1">Metodología</label>
            <textarea name="metodologia" rows="3"
                placeholder="Describa brevemente cómo se calcula el indicador..."
                class="w-full border border-gray-300 rounded px-3 py-2">{{ old('metodologia') }}</textarea>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3"
                placeholder="Información adicional sobre el indicador..."
                class="w-full border border-gray-300 rounded px-3 py-2">{{ old('descripcion') }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('indicadores.index', $meta->id) }}" class="text-blue-600 hover:underline">⬅️ Volver al listado</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                💾 Guardar
            </button>
        </div>
    </form>
</div>
@endsection
