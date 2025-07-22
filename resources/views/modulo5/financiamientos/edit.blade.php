@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">✏️ Editar Monto Asignado</h2>

    <form action="{{ route('financiamientos.update', $financiamiento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p><strong>Fuente:</strong> {{ $financiamiento->fuente->nombre }}</p>

        <div class="mb-4">
            <label class="block font-semibold">Monto:</label>
            <input type="number" step="0.01" name="monto" value="{{ $financiamiento->monto }}" class="form-input mt-1 w-full" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">💾 Actualizar</button>
    </form>
</div>
@endsection
