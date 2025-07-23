<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-bold mb-2">✅ Cierre y Distribución</h3>

    <p class="text-gray-700 mb-2">
        Esta pestaña finalizará oficialmente el ciclo de vida del proyecto. Se bloqueará la edición y se enviará el informe firmado a los entes correspondientes.
    </p>
    @if($proyecto->estado !== 'cerrado')
        <form action="{{ route('evaluacion7.cierre.store', $proyecto->id) }}" method="POST" class="space-y-4">
            @csrf
            <label class="block font-semibold">📝 Comentario final del cierre (opcional):</label>
            <textarea name="descripcion" class="form-textarea w-full" rows="3">{{ old('descripcion') }}</textarea>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                ✅ Confirmar Cierre del Proyecto
            </button>
        </form>
    @else
        <p class="text-green-700 font-semibold mb-4">✅ Este proyecto ya está cerrado.</p>
        <p class="text-sm text-gray-600">
            Cerrado por: {{ optional($proyecto->cierre->usuario)->name }}<br>
            Fecha de cierre: {{ $proyecto->cierre->fecha_cierre->format('d/m/Y H:i') }}
        </p>
    @endif

    <hr class="my-6">

    <h4 class="font-bold text-sm text-gray-700 mb-2">📥 Informe Final Firmado</h4>
    @if($informe)
        <a href="{{ asset('storage/'.$informe->archivo_pdf) }}" target="_blank" class="text-blue-600 underline">Descargar informe firmado</a>
    @else
        <p class="text-gray-500 text-sm">Informe aún no generado o firmado.</p>
    @endif
    <ul class="list-disc text-sm text-gray-600 pl-6">
        <li>Botón para marcar el proyecto como "Cerrado"</li>
        <li>Descarga y envío del informe firmado</li>
        <li>Bloqueo de edición posterior</li>
    </ul>
</div>
