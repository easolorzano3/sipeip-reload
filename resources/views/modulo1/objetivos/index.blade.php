<x-app-layout>
    <div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">🎯 Objetivos Estratégicos</h1>
                <a href="{{ route('objetivos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Nuevo Objetivo</a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded shadow-md">
                    <thead>
                        <tr class="bg-blue-100 text-left text-sm font-semibold text-gray-700">
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Descripción</th>
                            <th class="p-3">Plan</th>
                            <th class="p-3">Eje Estratégico</th>
                            <th class="p-3">Política Nacional</th>
                            <th class="p-3">Periodo</th>
                            <th class="p-3">Estado</th>
                            <th class="p-3 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($objetivos as $objetivo)
                            <tr class="border-b text-sm text-gray-800">
                                <td class="p-3">{{ $objetivo->nombre }}</td>
                                <td class="p-3">{{ Str::limit($objetivo->descripcion, 60) }}</td>
                                <td class="p-3">{{ $objetivo->planInstitucional->nombre ?? '-' }}</td>
                                <td class="p-3">{{ $objetivo->eje_estrategico_nombre ?? '-' }}</td>
                                <td class="p-3">{{ $objetivo->politica_nacional_nombre ?? '-' }}</td>
                                <td class="p-3">{{ $objetivo->periodo_inicio }} - {{ $objetivo->periodo_fin }}</td>
                                <td class="p-3">{{ $objetivo->estado }}</td>
                                <td class="p-3 text-center">
                                    <a href="{{ route('objetivos.edit', $objetivo->id) }}" class="text-yellow-500 hover:underline mr-3">Editar</a>
                                    <form action="{{ route('objetivos.destroy', $objetivo->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este objetivo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="p-4 text-center text-gray-500">No hay objetivos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
