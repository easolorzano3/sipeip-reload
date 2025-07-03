@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Permiso</h2>
    
    <form action="{{ route('permisos.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Ej. acceder_modulo_1" required>
        </div>

        <div class="mb-3">
            <label for="modulo_id" class="form-label">Asignar Módulos</label>
            <select name="modulo_id[]" id="modulo_id" class="form-select" multiple required>
                @foreach ($modulos as $modulo)
                    <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
            @endforeach
        </select>
        <small>Selecciona uno o más módulos con Ctrl/Cmd</small>
    </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('permisos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
