@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🛠️ Editar Rol: <span class="text-blue-600">{{ $role->name }}</span></h2>

    <form action="{{ route('roles.update', $role->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        {{-- Nombre del Rol --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="name">Nombre del Rol</label>
            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        {{-- Permisos --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Permisos</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($permissions as $permission)
                    <label class="inline-flex items-center bg-gray-50 px-3 py-2 rounded shadow-sm hover:bg-gray-100">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                               {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                        <span class="ml-2 text-sm text-gray-800">{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex items-center justify-start gap-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                ✅ Actualizar Rol
            </button>
            <a href="{{ route('roles.index') }}" class="text-gray-600 hover:text-red-500 font-semibold">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
