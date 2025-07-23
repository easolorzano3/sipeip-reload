<div class="bg-white p-4 rounded shadow">
    <h3 class="text-lg font-bold mb-2">📝 Conclusiones y Recomendaciones</h3>

    <p class="text-gray-700 mb-2">
        Aquí se registrarán las observaciones técnicas, advertencias al cierre y recomendaciones institucionales.
    </p>

    <ul class="list-disc text-sm text-gray-600 pl-6">
        <li>Observaciones finales de cumplimiento</li>
        <li>Riesgos o problemas detectados</li>
        <li>Sugerencias para futuras fases o proyectos</li>
    </ul>
    <form action="{{ route('evaluacion7.conclusiones.store', $proyecto->id) }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block font-bold text-sm mb-1">📌 Observaciones Finales</label>
            <textarea name="observaciones" class="form-textarea w-full" rows="3">{{ old('observaciones', $conclusion->observaciones ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-bold text-sm mb-1 text-red-700">⚠️ Advertencias al Cierre</label>
            <textarea name="advertencias" class="form-textarea w-full text-red-700" rows="3">{{ old('advertencias', $conclusion->advertencias ?? '') }}</textarea>
        </div>

        <div>
            <label class="block font-bold text-sm mb-1 text-green-700">💡 Recomendaciones Institucionales</label>
            <textarea name="recomendaciones" class="form-textarea w-full text-green-700" rows="3">{{ old('recomendaciones', $conclusion->recomendaciones ?? '') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
            Guardar Conclusiones
        </button>
    </form>

    <p class="text-xs text-gray-400 mt-4">* Formularios nuevos, información escrita por el evaluador</p>
</div>
