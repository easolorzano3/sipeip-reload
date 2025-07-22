@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📤 Enviar Certificación al eSIGEF</h2>

    <p class="mb-2"><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>

    <form action="{{ route('envios-sigef.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

        <div>
            <label class="block font-semibold">📎 Archivo de Certificación (PDF):</label>
            <input type="file" name="archivo_certificacion" accept="application/pdf" class="form-input w-full mt-1" required>
            @error('archivo_certificacion')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold">📥 Respuesta del sistema eSIGEF (simulada):</label>
            <select name="respuesta_sistema" class="form-select w-full mt-1" required>
                <option value="">-- Seleccionar respuesta --</option>
                <option value="aprobado">✔ Aprobado</option>
                <option value="rechazado">✘ Rechazado</option>
            </select>
            @error('respuesta_sistema')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block font-semibold">📝 Observaciones (opcional):</label>
            <textarea name="observaciones" class="form-textarea w-full mt-1" rows="3" placeholder="Ej: Certificación verificada y aprobada por el sistema eSIGEF..."></textarea>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                🚀 Enviar Simulación
            </button>
        </div>
    </form>

    <div class="mt-6">
        <a href="{{ route('envios-sigef.index') }}" class="text-blue-600 hover:underline">← Volver a envíos</a>
    </div>
</div>
@endsection
