<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Administración y Seguridad') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">
                <h4 class="mb-4">Submódulos disponibles:</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('usuarios.index') }}" class="btn bg-blue-500 hover:bg-blue-600 text-white p-4 rounded shadow text-center">
                        👤 Gestión de Usuarios
                    </a>
                    <a href="{{ route('roles.index') }}" class="btn bg-green-500 hover:bg-green-600 text-white p-4 rounded shadow text-center">
                        🔐 Gestión de Roles
                    </a>
                    <a href="{{ route('permisos.index') }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded shadow text-center">
                        🛡️ Gestión de Permisos
                    </a>
                    <a href="{{ route('bitacora.index') }}" class="btn bg-gray-700 hover:bg-gray-800 text-white p-4 rounded shadow text-center">
                        📜 Bitácora del Sistema
                    </a>
                    <a href="{{ route('configuracion.index') }}" class="btn bg-purple-500 hover:bg-purple-600 text-white p-4 rounded shadow text-center">
                        ⚙️ Configuración
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
