@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📤 Enviar Plan Institucional a Revisión</h2>

    <form action="{{ route('revision.store') }}" method="POST">
        @csrf

        {{-- Plan a enviar --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">📋 Selecciona un plan:</label>
            <select name="plan_id" class="form-select w-full" required>
                <option value="">-- Selecciona un plan --</option>
                @foreach ($planes as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Observaciones --}}
        <div class="mb-4">
            <label class="block font-semibold mb-1">📝 Observaciones (opcional):</label>
            <textarea name="observaciones" class="form-textarea w-full" rows="4" placeholder="Escribe alguna observación si lo deseas..."></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Enviar a Revisión
        </button>
    </form>
</div>
@endsection
