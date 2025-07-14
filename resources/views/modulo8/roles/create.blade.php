@extends('layouts.app')

@section('content')
<div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 bg-white rounded-xl shadow p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            ➕ Crear Rol
        </h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Rol</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       placeholder="Ej. planificador"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Permisos</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($permissions as $permission)
                        <label class="flex items-center space-x-2 bg-gray-50 px-3 py-2 rounded shadow-sm border">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                   class="text-blue-600 border-gray-300 rounded">
                            <span class="text-sm text-gray-700">{{ $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-start items-center space-x-4">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
                    💾 Crear Rol
                </button>
                <a href="{{ route('roles.index') }}"
                   class="text-gray-600 hover:text-gray-800 font-medium">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
