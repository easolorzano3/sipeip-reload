@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">➕ Registrar Documento de Respaldo</h2>

    <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf

        <div>
            <label class="block font-medium">Plan Institucional</label>
            <select name="plan_id" class="w-full rounded border-gray-300">
                <option value="">Seleccione un plan</option>
                @foreach ($planes as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-medium">Nombre del Documento</label>
            <input type="text" name="nombre_documento" class="w-full rounded border-gray-300">
        </div>

        <div>
            <label class="block font-medium">Archivo</label>
            <input type="file" name="archivo" class="w-full border-gray-300 rounded">
        </div>

        <div>
            <label class="block font-medium">Tipo</label>
            <input type="text" name="tipo" class="w-full rounded border-gray-300">
        </div>

        <div>
            <label class="block font-medium">Fecha de Carga</label>
            <input type="date" name="fecha_carga" class="w-full rounded border-gray-300">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('documentos.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Guardar</button>
        </div>
    </form>
</div>
@endsection
