<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-bold mb-2">📄 Informe Final y Firma Electrónica</h3>

    <p class="text-gray-700 mb-2">
        Aquí se consolidará la información para generar el informe PDF de cierre institucional. El evaluador podrá firmar electrónicamente.
    </p>
    @if($informe)
        <p class="text-green-700 mb-2">✅ Informe generado: <a href="{{ asset('storage/'.$informe->archivo_pdf) }}" target="_blank" class="underline text-blue-600">Ver PDF</a></p>

        @if(!$informe->firmado_en)
            <form action="{{ route('evaluacion7.informe.firmar', $proyecto->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    🖊️ Firmar Informe
                </button>
            </form>
        @else
            <p class="text-sm text-gray-600">📅 Firmado el {{ $informe->firmado_en->format('d/m/Y H:i') }} por {{ optional($informe->usuario)->name }}</p>
        @endif
    @else
        <form action="{{ route('evaluacion7.informe.generar', $plan->id) }}" method="POST" target="_blank">
            @csrf
            <button type="submit" class="btn btn-primary">
                📄 Generar Informe PDF
            </button>
        </form>

    @endif
    <ul class="list-disc text-sm text-gray-600 pl-6">
        <li>Revisión del contenido generado automáticamente</li>
        <li>Botón para firmar electrónicamente</li>
        <li>Registro en bitácora</li>
    </ul>
</div>
