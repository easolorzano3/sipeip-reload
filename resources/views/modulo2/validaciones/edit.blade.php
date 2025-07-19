@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Validar Plan Institucional</h2>

    <p><strong>Nombre del Plan:</strong> {{ $plan->nombre }}</p>

    <form method="POST" action="{{ route('validaciones.update', $plan->id) }}">
        @csrf
        @method('PUT')

        <div class="mt-4">
            <label class="block font-semibold">Nuevo Estado</label>
            <select name="estado_id" class="form-select w-full" required>
                <option value="">-- Selecciona Estado --</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->id }}">{{ ucfirst($estado->nombre) }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Guardar Validación
        </button>
    </form>
</div>
@endsection
