@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">💰 Asignar Fuentes de Financiamiento</h2>

    <form action="{{ route('financiamientos.store') }}" method="POST">
        @csrf

        <input type="hidden" name="proyecto_id" value="{{ $proyecto->id }}">

        @foreach($fuentes as $fuente)
            <tr>
                <td>{{ $fuente->nombre }}</td>
                <td>
                    <input type="number" name="anios[{{ $fuente->id }}]" class="form-input" placeholder="Ej: 2025">

                </td>
                <td>
                    <input type="number" name="montos[{{ $fuente->id }}]" class="form-input w-full" step="0.01" min="0">
                </td>
            </tr>

        @endforeach

        <div class="mt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                💾 Guardar
            </button>
        </div>
    </form>
</div>
@endsection
