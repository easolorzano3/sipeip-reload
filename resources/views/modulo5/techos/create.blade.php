@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">🏗️ Asignar Techo Multianual</h2>

    <div class="bg-white shadow-md rounded p-6">
        <form action="{{ route('techos.store') }}" method="POST">
            @csrf
            <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

            <div class="grid grid-cols-1 gap-4">
                @foreach ($anios as $anio)
                    <div class="flex items-center gap-4">
                        <label class="w-1/3 font-semibold text-gray-700">Año {{ $anio }}:</label>
                        <input type="number" step="0.01" name="montos[{{ $anio }}]" class="form-input w-2/3 border rounded px-3 py-2" placeholder="Ingrese monto para {{ $anio }}">
                    </div>
                @endforeach
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    💾 Guardar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
