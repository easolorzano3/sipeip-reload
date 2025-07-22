@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">➕ Registrar Nuevo Avance Físico</h2>

    <form action="{{ route('avance-fisico.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Proyecto:</label>
            <select name="proyecto_id" class="form-select w-full" required>
                <option value="">-- Selecciona --</option>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Fase:</label>
            <input type="text" name="fase" class="form-input w-full" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Meta (opcional):</label>
            <select name="meta_id" class="form-select w-full">
                <option value="">-- Sin meta --</option>
                @foreach ($metas as $meta)
                    <option value="{{ $meta->id }}">{{ $meta->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Porcentaje de avance:</label>
            <input type="number" name="porcentaje" class="form-input w-full" step="0.01" max="100" required>
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-1">Fecha de corte:</label>
            <input type="date" name="fecha_corte" class="form-input w-full" required>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn btn-success">💾 Guardar</button>
            <a href="{{ route('avance-fisico.index') }}" class="btn btn-secondary">↩️ Cancelar</a>
        </div>
    </form>
</div>
@endsection
