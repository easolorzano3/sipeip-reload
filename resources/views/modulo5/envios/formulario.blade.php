@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📤 Enviar a eSIGEF</h2>

    <p class="mb-2"><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
    <p class="mb-4"><strong>Código:</strong> {{ $proyecto->codigo }}</p>

    <form action="{{ route('envios-sigef.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

        <div>
            <label class="block font-medium">📎 Subir Certificación Firmada (PDF):</label>
            <input type="file" name="archivo_certificacion" accept="application/pdf" required class="mt-1 border rounded px-2 py-1 w-full">
        </div>

        <div>
            <label class="block font-medium">📌 Resultado del Sistema:</label>
            <select name="respuesta_sistema" required class="mt-1 border rounded px-2 py-1 w-full">
                <option value="">-- Seleccionar --</option>
                <option value="aprobado">✅ Aprobado</option>
                <option value="rechazado">❌ Rechazado</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">📝 Observaciones (opcional):</label>
            <textarea name="observaciones" rows="3" class="mt-1 border rounded px-2 py-1 w-full"></textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded mt-4">
            🚀 Enviar Simulación
        </button>

    </form>
</div>
@endsection
