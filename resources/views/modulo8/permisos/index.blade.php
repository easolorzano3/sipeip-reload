@extends('layouts.app')

@section('content')
<div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">🔐 Gestión de Permisos</h1>
            <a href="{{ route('permisos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                + Nuevo Permiso
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if($permisos->count())
            <div class="overflow-x-auto bg-white shadow rounded-xl">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-blue-100 text-gray-700 text-left">
                        <tr>
                            <th class="px-6 py-3 font-semibold">Nombre del Permiso</th>
                            <th class="px-6 py-3 font-semibold">Módulos Asignados</th>
                            <th class="px-6 py-3 font-semibold text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($permisos as $permiso)
                            <tr>
                                <td class="px-6 py-4 text-gray-800">{{ $permiso->name }}</td>
                                <td class="px-6 py-4">
                                    @foreach($permiso->modulos as $modulo)
                                        <span class="inline-block bg-blue-200 text-blue-800 text-xs px-3 py-1 rounded-full mr-2 mb-1">
                                            {{ $modulo->nombre }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-4 text-center space-x-2">
                                    <a href="{{ route('permisos.edit', $permiso->id) }}"
                                       class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-3 py-1 rounded shadow">
                                        Editar
                                    </a>
                                    <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST" class="inline-block"
                                          onsubmit="return confirm('¿Estás seguro de eliminar este permiso?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-1 rounded shadow">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded shadow mt-6">
                No hay permisos registrados actualmente.
            </div>
        @endif
    </div>
</div>
@endsection
