@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Editar Documento</h2>

    <form action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Plan Institucional</label>
            <select name="plan_id" class="w-full rounded border-gray-300">
                @foreach ($planes as $plan)
                    <option value="{{ $plan->id }}" {{ $plan->id == $documento->plan_id ? 'selected' : '' }}>{{ $plan->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Nombre del Documento</label>
            <input type="text" name="nombre_documento" value="{{ $documento->nombre_documento }}" class="w-full rounded border-gray-300">
        </div>

        <div>
            <label class="block font-medium">Archivo (opcional)</label>
            <input type="file" name="archivo" class="w-full border-gray-300 rounded">
            <p class="text-sm mt-1">Archivo actual: <a href="{{ asset('storage/' . $documento->archivo) }}" target="_blank" class="text-blue-600 underline">Ver documento</a></p>
        </div>

        <div>
            <label class="block font-medium">Tipo</label>
            <input type="text" name="tipo" value="{{ $documento->tipo }}" class="w-full rounded border-gray-300">
        </div>

        <div>
            <label class="block font-medium">Fecha de Carga</label>
            <input type="date" name="fecha_carga" value="{{ $documento->fecha_carga }}" class="w-full rounded border-gray-300">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('documentos.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Actualizar</button>
        </div>
    </form>
</div>
@endsection
