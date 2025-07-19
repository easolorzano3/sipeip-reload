@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Actualizar Revisión del Plan</h2>

    <form action="{{ route('revision.update', $envio->id) }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Plan Institucional</label>
            <input type="text" class="w-full border rounded p-2 bg-gray-100" value="{{ $envio->plan->nombre ?? 'N/A' }}" disabled>
        </div>

        <div>
            <label class="block font-medium">Estado de Revisión</label>
            <select name="estado_envio" required class="w-full border rounded p-2">
                <option value="Enviado" {{ $envio->estado_envio == 'Enviado' ? 'selected' : '' }}>Enviado</option>
                <option value="Aprobado" {{ $envio->estado_envio == 'Aprobado' ? 'selected' : '' }}>Aprobado</option>
                <option value="Observado" {{ $envio->estado_envio == 'Observado' ? 'selected' : '' }}>Observado</option>
                <option value="Rechazado" {{ $envio->estado_envio == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Respuesta / Observaciones del Revisor</label>
            <textarea name="respuesta" rows="4" class="w-full border rounded p-2">{{ $envio->respuesta }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Fecha de Respuesta</label>
            <input type="date" name="fecha_respuesta" value="{{ $envio->fecha_respuesta }}" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('revision.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Actualizar</button>
        </div>
    </form>
</div>
@endsection
