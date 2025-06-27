@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Módulo 8: Administración y Seguridad</h2>
    <p>¡Has ingresado correctamente al módulo!</p>

    <div class="row g-4 mt-4">
        <div class="col-md-4">
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary w-100">👥 Gestión de Usuarios</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary w-100">🔐 Gestión de Roles</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('permisos.index') }}" class="btn btn-info w-100">🛡️ Gestión de Permisos</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('bitacora.index') }}" class="btn btn-dark w-100">📜 Bitácora</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('configuracion.index') }}" class="btn btn-warning w-100">⚙️ Configuración</a>
        </div>
    </div>
</div>
@endsection
