@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">👤 Crear Nuevo Usuario Institucional</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input type="text" id="nombres" name="nombres" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Institucional</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="ejemplo@institucion.gob.ec" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="unidad_id" class="form-label">Unidad Organizativa</label>
                        <select id="unidad_organizacional_id" name="unidad_organizacional_id" class="form-select" required>
                            <option value="">-- Selecciona una unidad --</option>
                            @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                        <div class="col-md-6">
                            <label for="roles" class="form-label">Roles</label>
                            <select id="roles" name="roles[]" class="form-select" multiple required>
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
