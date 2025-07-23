<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-bold mb-2">📘 Lecciones Aprendidas</h3>

    <p class="text-gray-700 mb-2">
        En esta sección se documentarán experiencias, buenas prácticas y errores detectados durante la ejecución del proyecto.
    </p>
    {{-- Formulario de ingreso --}}
<form action="{{ route('evaluacion7.lecciones.store', $proyecto->id) }}" method="POST" class="mb-6 space-y-4">
    @csrf

    <div>
        <label class="font-semibold">Tipo de Lección</label>
        <select name="tipo" class="form-select w-full" required>
            <option value="">-- Seleccionar --</option>
            <option value="error">❌ Error</option>
            <option value="acierto">✅ Acierto</option>
            <option value="mejora">🔧 Mejora</option>
        </select>
    </div>

    <div>
        <label class="font-semibold">Descripción</label>
        <textarea name="descripcion" class="form-textarea w-full" rows="3" required>{{ old('descripcion') }}</textarea>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        Guardar Lección
    </button>
</form>

{{-- Tabla de lecciones registradas --}}
    @if($lecciones->count())
        <table class="w-full table-auto border text-sm">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="p-2 border">Tipo</th>
                    <th class="p-2 border">Descripción</th>
                    <th class="p-2 border">Registrado por</th>
                    <th class="p-2 border">Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lecciones as $leccion)
                    <tr>
                        <td class="border p-2 font-semibold capitalize">{{ $leccion->tipo }}</td>
                        <td class="border p-2">{{ $leccion->descripcion }}</td>
                        <td class="border p-2">{{ optional($leccion->usuario)->name }}</td>
                        <td class="border p-2">{{ $leccion->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-gray-500 text-sm">No hay lecciones registradas aún.</p>
    @endif
    <ul class="list-disc text-sm text-gray-600 pl-6">
        <li>Aprendizajes técnicos o de gestión</li>
        <li>Errores comunes y cómo prevenirlos</li>
        <li>Sugerencias aplicables a otros proyectos</li>
    </ul>
</div>
