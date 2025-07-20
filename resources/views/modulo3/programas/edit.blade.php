@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">✏️ Editar Programa</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('programas.update', $programa->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">📌 Nombre del Programa:</label>
                <input type="text" name="nombre" value="{{ old('nombre', $programa->nombre) }}"
                    class="form-input w-full rounded border-gray-300" required>
            </div>

            <div>
                <label class="block font-semibold">📝 Descripción:</label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $programa->descripcion) }}"
                    class="form-input w-full rounded border-gray-300">
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">🏷️ Sector:</label>
                <input type="text" name="sector" value="{{ old('sector', $programa->sector) }}"
                    class="form-input w-full rounded border-gray-300">
            </div>
        </div>

        <div class="flex gap-4 mt-6">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                💾 Guardar Cambios
            </button>

            <a href="{{ route('programas.indexPorPlan', $programa->plan_id) }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                🔙 Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
