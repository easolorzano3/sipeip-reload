@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📄 Publicar nueva resolución</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('resoluciones.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="plan_id" class="block font-semibold">📘 Seleccione un plan aprobado:</label>
            <select name="plan_id" id="plan_id" class="w-full border border-gray-300 rounded p-2" required>
                <option value="">-- Seleccione --</option>
                @forelse ($planes as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->nombre }}</option>
                @empty
                    <option disabled>No hay planes aprobados disponibles</option>
                @endforelse
            </select>
        </div>

        <div>
            <label for="numero" class="block font-semibold">🔢 Número de Resolución:</label>
            <input type="text" name="numero" class="form-control px-3 py-2 border rounded w-full" placeholder="Ej: R-SIPEIP-001-2025" required>


        </div>

        <div>
            <label for="fecha" class="block font-semibold">📅 Fecha de Resolución:</label>
            <input type="date" name="fecha" id="fecha" class="w-full border border-gray-300 rounded p-2" required>
        </div>

        <div>
            <label for="archivo" class="block font-semibold">📎 Subir archivo (PDF):</label>
            <input type="file" name="archivo" id="archivo" accept=".pdf" class="w-full" required>
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                ✅ Publicar resolución
            </button>
        </div>
    </form>
</div>
@endsection
