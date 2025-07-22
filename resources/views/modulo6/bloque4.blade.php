<div class="bg-white shadow-md rounded p-6">
    <h2 class="text-xl font-semibold mb-4">📊 Reportes y Contratación</h2>
    <p class="text-sm text-gray-600 mb-6">Selecciona un proyecto para visualizar su reporte detallado.</p>

    @if($proyectos_viables->isNotEmpty())
        <table class="min-w-full border border-gray-300 rounded text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nombre del Proyecto</th>
                    <th class="px-4 py-2 border">Código</th>
                    <th class="px-4 py-2 border">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proyectos_viables as $proyecto)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $proyecto->nombre }}</td>
                        <td class="px-4 py-2 border">{{ $proyecto->codigo }}</td>
                        <td class="px-4 py-2 border text-center">
                            <a href="{{ route('modulo6.reportes.show', $proyecto->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">
                                📄 Ver Reporte
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 text-sm">No hay proyectos viables disponibles para generar reportes.</p>
    @endif
</div>
