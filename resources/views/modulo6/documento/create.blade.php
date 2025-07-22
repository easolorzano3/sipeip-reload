@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-bold mb-4">📥 Registrar Documento de Evidencia</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documentos-evidencias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Proyecto --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Proyecto</label>
            <select name="proyecto_id" class="form-select w-full border-gray-300 rounded" required>
                <option value="">-- Selecciona un proyecto --</option>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tipo de documento --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipo de documento</label>
            <input type="text" name="tipo" class="form-input w-full border-gray-300 rounded" required>
        </div>

        {{-- Descripción --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Descripción (opcional)</label>
            <textarea name="descripcion" rows="3" class="form-textarea w-full border-gray-300 rounded"></textarea>
        </div>

        {{-- Archivo --}}
        <div>
            <label class="block text-sm font-medium text-gray-700">Archivo (PDF, DOCX, JPG, PNG...)</label>
            <input type="file" name="archivo" class="form-input w-full border-gray-300 rounded" required>
        </div>

        {{-- Botones --}}
        <div class="flex justify-end gap-2">
            <a href="{{ route('modulo6.dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">💾 Guardar</button>
        </div>
    </form>
</div>
@endsection
