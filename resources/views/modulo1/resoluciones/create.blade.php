@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📄 Publicar Resolución</h2>

    <form action="{{ route('resoluciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label class="font-semibold">Seleccionar Plan Aprobado:</label>
            <select name="plan_id" class="form-select w-full" required>
                <option value="">-- Selecciona un plan --</option>
                @foreach($planes as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Número de Resolución:</label>
            <input type="text" name="numero" class="form-control" placeholder="Ej: MINTRA-R001-2025" required>
        </div>

        <div>
            <label class="font-semibold">Fecha de Resolución:</label>
            <input type="date" name="fecha" class="form-input w-full" required>
        </div>

        <div>
            <label class="font-semibold">Archivo PDF:</label>
            <input type="file" name="archivo" accept="application/pdf" class="form-input w-full" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            📤 Publicar Resolución
        </button>
    </form>
</div>
@endsection
