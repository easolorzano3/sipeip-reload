@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">🎭 Gestión de Roles</h2>

    <a href="{{ route('roles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
        + Nuevo Rol
    </a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold">#</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold">Nombre del Rol</th>
                    <th class="px-6 py-3 text-left text-gray-600 font-semibold">Permisos</th>
                    <th class="px-6 py-3 text-center text-gray-600 font-semibold">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($roles as $index => $rol)
                <tr>
                    <td class="px-6 py-4 text-gray-800 font-medium">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-gray-800 font-medium">
                        <span class="bg-cyan-100 text-cyan-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $rol->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach ($rol->permissions as $permiso)
                                <span class="bg-gray-200 text-gray-700 text-xs font-medium px-2.5 py-0.5 rounded">
                                    {{ $permiso->name }}
                                </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('roles.edit', $rol->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded">
                            Editar
                        </a>
                        <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Estás seguro de eliminar este rol?')" class="bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
