@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">✏️ Editar Avance Financiero</h2>

    <form action="{{ route('avance-financiero.update', $avance->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Proyecto:</label>
            <select name="proyecto_id" class="form-select" required>
                @foreach($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}" {{ $avance->proyecto_id == $proyecto->id ? 'selected' : '' }}>
                        {{ $proyecto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Componente:</label>
            <input type="text" name="componente" class="form-control" value="{{ $avance->componente }}" required>
        </div>

        <div class="mb-3">
            <label>Valor Ejecutado:</label>
            <input type="number" name="valor_ejecutado" class="form-control" step="0.01" min="0" value="{{ $avance->valor_ejecutado }}" required>
        </div>

        <div class="mb-3">
            <label>Fecha de corte:</label>
            <input type="date" name="fecha_corte" class="form-control" value="{{ $avance->fecha_corte }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('avance-financiero.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
