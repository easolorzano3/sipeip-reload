@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Permiso</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Hay problemas con los datos ingresados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('permisos.update', $permiso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Permiso</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $permiso->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="modulo_id" class="form-label">Asignar Módulos</label>
            <select name="modulo_id[]" id="modulo_id" class="form-select" multiple required>
                @foreach ($modulos as $modulo)
                    <option value="{{ $modulo->id }}" 
                        {{ $permiso->modulos->contains($modulo->id) ? 'selected' : '' }}>
                        {{ $modulo->nombre }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar varios módulos.</small>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('permisos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
