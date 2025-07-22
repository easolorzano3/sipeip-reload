@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6 flex items-center">
        ✏️ <span class="ml-2">Editar Avance Físico</span>
    </h2>

    <form action="{{ route('avance-fisico.update', $avance->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Proyecto:</label>
            <select name="proyecto_id" class="form-select w-full rounded border-gray-300" required>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}" {{ $avance->proyecto_id == $proyecto->id ? 'selected' : '' }}>
                        {{ $proyecto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Fase:</label>
            <input type="text" name="fase" class="form-input w-full rounded border-gray-300" value="{{ $avance->fase }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Meta (opcional):</label>
            <select name="meta_id" class="form-select w-full rounded border-gray-300">
                <option value="">-- Sin meta --</option>
                @foreach ($metas as $meta)
                    <option value="{{ $meta->id }}" {{ $avance->meta_id == $meta->id ? 'selected' : '' }}>
                        {{ $meta->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Porcentaje de avance:</label>
            <input type="number" name="porcentaje" class="form-input w-full rounded border-gray-300" value="{{ $avance->porcentaje }}" step="0.01" max="100" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Fecha de corte:</label>
            <input type="date" name="fecha_corte" class="form-input w-full rounded border-gray-300" value="{{ $avance->fecha_corte }}" required>
        </div>

        <div class="flex items-center justify-start gap-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">💾 Actualizar</button>
            <a href="{{ route('avance-fisico.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">↩️ Cancelar</a>
        </div>
    </form>
</div>
@endsection
