@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">🆕 Nuevo Programa</h2>

    <form action="{{ route('programas.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold">📄 Plan Institucional</label>
            <input type="text" class="w-full bg-gray-100 p-2 rounded" value="{{ $plan->nombre }}" disabled>
            <input type="hidden" name="plan_id" value="{{ $plan->id }}">
        </div>

        <div class="mb-4">
            <label class="block font-semibold">📌 Nombre del Programa</label>
            <input type="text" name="nombre" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">📝 Descripción</label>
            <textarea name="descripcion" class="w-full p-2 border rounded"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">🏢 Sector</label>
            <input type="text" name="sector" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Guardar Programa
        </button>
    </form>
</div>
@endsection
