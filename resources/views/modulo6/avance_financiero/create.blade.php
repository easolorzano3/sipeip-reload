@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">➕ Nuevo Avance Financiero</h2>

    <form action="{{ route('avance-financiero.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Proyecto:</label>
            <select name="proyecto_id" class="form-select" required>
                <option value="">-- Selecciona un proyecto --</option>
                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Componente:</label>
            <input type="text" name="componente" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Valor Ejecutado:</label>
            <input type="number" name="valor_ejecutado" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label>Fecha de corte:</label>
            <input type="date" name="fecha_corte" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('avance-financiero.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
