@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Editar Meta</h2>

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
    <form action="{{ route('metas.update', $meta->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Objetivo estratégico asociado (solo mostrar) --}}
            <div>
                <label class="block text-sm font-medium mb-1">Objetivo Estratégico Asociado</label>
                <input type="text" value="{{ $meta->objetivoEstrategico->nombre }}" readonly
                    class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100">

                <input type="hidden" name="objetivo_estrategico_id" value="{{ $meta->objetivo_estrategico_id }}">
            </div>

            {{-- Nombre de la Meta --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nombre de la Meta <span class="text-red-600">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre', $meta->nombre) }}" required
                    class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('descripcion', $meta->descripcion) }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('metas.index') }}" class="text-blue-600 hover:underline">⬅️ Volver al listado</a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                💾 Actualizar
            </button>
        </div>
    </form>
</div>
@endsection
