@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestión de Permisos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('permisos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Permiso</a>

    @if($permisos->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Permiso</th>
                    <th>Módulos Asignados</th> <!-- Nueva columna -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($permisos as $permiso)
                    <tr>
                        <td>{{ $permiso->name }}</td>
                        <td>
                            @foreach($permiso->modulos as $modulo)
                                <span class="badge bg-info text-dark">{{ $modulo->nombre }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('permisos.edit', $permiso->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar este permiso?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    @else
        <p>No hay permisos registrados.</p>
    @endif
</div>
@endsection
