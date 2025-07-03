@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestión de Roles</h2>
    <p>Define y administra los roles de acceso al sistema, así como su relación con los permisos.</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('roles.create') }}" class="btn btn-primary">+ Crear nuevo rol</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre del Rol</th>
                <th>Permisos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        @foreach ($role->permissions as $permission)
                            <span class="badge bg-secondary">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Editar</a>

                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este rol?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No hay roles registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
