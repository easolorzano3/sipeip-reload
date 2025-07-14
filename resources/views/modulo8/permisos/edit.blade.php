@extends('layouts.app')

@section('content')
<div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white rounded-xl shadow p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            ✏️ Editar Permiso: <span class="ml-2 text-blue-700">{{ $permiso->name }}</span>
        </h1>

        <form method="POST" action="{{ route('permisos.update', $permiso->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Permiso</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $permiso->name) }}"
                       class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label for="modulos" class="block text-sm font-medium text-gray-700">Asignar Módulos</label>
                <select name="modulos[]" id="modulos" multiple
                        class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    @foreach($modulos as $modulo)
                        <option value="{{ $modulo->id }}"
                            {{ in_array($modulo->id, $permiso->modulos->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $modulo->nombre }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Mantén presionada la tecla Ctrl (o Cmd en Mac) para seleccionar varios módulos.</p>
            </div>

            <div class="flex justify-start items-center space-x-4">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
                    ✅ Actualizar
                </button>
                <a href="{{ route('permisos.index') }}"
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
