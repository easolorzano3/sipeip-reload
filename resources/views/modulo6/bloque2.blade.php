<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold mb-4 text-gray-800">📁 Registrar Evidencia Documental</h3>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('documentos-evidencias.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Proyecto:</label>
            <select name="proyecto_id" class="form-select mt-1 block w-full border rounded px-2 py-1" required>
                <option value="">-- Selecciona un proyecto --</option>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tipo de Documento:</label>
            <input type="text" name="tipo" class="form-input mt-1 block w-full border rounded px-2 py-1" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Descripción (opcional):</label>
            <textarea name="descripcion" rows="3" class="form-textarea mt-1 block w-full border rounded px-2 py-1"></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Archivo:</label>
            <input type="file" name="archivo" class="form-input mt-1 block w-full border rounded px-2 py-1" required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                📥 Subir Documento
            </button>
        </div>
    </form>
    @if ($documentos->count())
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📄 Evidencias Registradas</h3>

            <table class="table-auto w-full border rounded shadow text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Proyecto</th>
                        <th class="px-3 py-2 text-left">Tipo</th>
                        <th class="px-3 py-2 text-left">Descripción</th>
                        <th class="px-3 py-2 text-left">Usuario</th>
                        <th class="px-3 py-2 text-left">Archivo</th>
                        <th class="px-3 py-2 text-left">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos as $doc)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $doc->proyecto->nombre ?? '—' }}</td>
                            <td class="px-3 py-2">{{ $doc->tipo }}</td>
                            <td class="px-3 py-2">{{ $doc->descripcion ?? '—' }}</td>
                            <td class="px-3 py-2">{{ $doc->usuario->nombres }} {{ $doc->usuario->apellidos }}</td>
                            <td class="px-3 py-2">
                                <a href="{{ asset('storage/' . $doc->ruta_archivo) }}" target="_blank" class="text-blue-600 hover:underline">📎 Ver/Descargar</a>
                            </td>
                            <td class="px-3 py-2">{{ $doc->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
