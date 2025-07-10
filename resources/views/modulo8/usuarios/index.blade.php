@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Gestión de Usuarios</h4>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">+ Nuevo Usuario</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Roles</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $index => $usuario)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $usuario->nombres }}</td>
                <td>{{ $usuario->apellidos }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    @foreach ($usuario->roles as $rol)
                        <span class="badge bg-info text-white">{{ $rol->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach ($usuario->getAllPermissions() as $permiso)
                        <span class="badge bg-secondary">{{ $permiso->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
