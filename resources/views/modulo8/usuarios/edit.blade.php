@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Editar Usuario</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Nombres</label>
                <input type="text" name="nombres" value="{{ old('nombres', $usuario->nombres) }}" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block text-sm font-medium">Apellidos</label>
                <input type="text" name="apellidos" value="{{ old('apellidos', $usuario->apellidos) }}" class="w-full border rounded p-2" required>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Unidad Organizacional</label>
            <select name="unidad_organizacional_id" class="w-full border rounded p-2">
                <option value="">-- Selecciona una unidad --</option>
                @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}" {{ $usuario->unidad_organizacional_id == $unidad->id ? 'selected' : '' }}>
                        {{ $unidad->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Nueva Contraseña <span class="text-gray-500">(opcional)</span></label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block text-sm font-medium">Roles</label>
            <select name="roles[]" class="w-full border rounded p-2" multiple>
                @foreach ($roles as $rol)
                    <option value="{{ $rol->name }}" {{ $usuario->roles->contains('name', $rol->name) ? 'selected' : '' }}>
                        {{ $rol->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Actualizar Usuario
            </button>
            <a href="{{ route('usuarios.index') }}" class="ml-4 text-gray-600 hover:underline">Cancelar</a>
        </div>
    </form>
</div>
@endsection
