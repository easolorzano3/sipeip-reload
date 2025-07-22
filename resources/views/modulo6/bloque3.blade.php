<div class="bg-white shadow-md rounded-lg p-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">🗓️ Registrar Planificación Ejecutiva</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 border border-green-200 px-4 py-2 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('planificaciones-ejecutivas.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Proyecto --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Proyecto <span class="text-red-500">*</span></label>
                <select name="proyecto_id" class="form-select w-full border-gray-300 rounded focus:ring focus:ring-indigo-200" required>
                    <option value="">-- Selecciona un proyecto --</option>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Hito --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Hito <span class="text-red-500">*</span></label>
                <input type="text" name="hito" class="form-input w-full border-gray-300 rounded focus:ring focus:ring-indigo-200" placeholder="Ej. Inicio de obra" required>
            </div>

            {{-- Fecha --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Fecha Programada <span class="text-red-500">*</span></label>
                <input type="date" name="fecha" class="form-input w-full border-gray-300 rounded focus:ring focus:ring-indigo-200" required>
            </div>

            {{-- Responsable --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Responsable</label>
                <input type="text" name="responsable" class="form-input w-full border-gray-300 rounded focus:ring focus:ring-indigo-200" placeholder="Ej. Ing. Pérez">
            </div>
        </div>

        {{-- Observaciones --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Observación</label>
            <textarea name="observacion" rows="3" class="form-textarea w-full border-gray-300 rounded focus:ring focus:ring-indigo-200" placeholder="Comentario adicional..."></textarea>
        </div>

        <div class="text-right pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-semibold shadow">
                💾 Registrar Hito
            </button>
        </div>
    </form>

    {{-- Tabla de resultados --}}
@if($planificaciones->isNotEmpty())
    <div class="mt-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">📋 Hitos Registrados</h3>
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-200 text-sm text-gray-700 bg-white rounded">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border">Proyecto</th>
                        <th class="px-4 py-2 border">Hito</th>
                        <th class="px-4 py-2 border">Fecha</th>
                        <th class="px-4 py-2 border">Responsable</th>
                        <th class="px-4 py-2 border">Observación</th>
                        <th class="px-4 py-2 border">Usuario</th>
                        <th class="px-4 py-2 border text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planificaciones as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">{{ $item->proyecto->nombre ?? 'N/D' }}</td>
                            <td class="px-4 py-2 border">{{ $item->hito }}</td>
                            <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($item->fecha)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2 border">{{ $item->responsable ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $item->observacion ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $item->usuario->nombres ?? '—' }} {{ $item->usuario->apellidos ?? '' }}</td>
                            <td class="px-4 py-2 border text-center">
                                <form action="{{ route('planificaciones-ejecutivas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este hito?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@else
    <p class="text-sm text-gray-500 mt-6">No se han registrado hitos aún.</p>
@endif

</div>
