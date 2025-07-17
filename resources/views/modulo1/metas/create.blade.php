@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">➕ Registrar Meta</h2>

    <form action="{{ route('metas.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">Objetivo Estratégico <span class="text-red-600">*</span></label>
            <select name="objetivo_estrategico_id" class="w-full border px-3 py-2 rounded" required>
                <option value="">Seleccione...</option>
                @foreach($objetivos as $obj)
                    <option value="{{ $obj->id }}">{{ $obj->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Nombre de la Meta <span class="text-red-600">*</span></label>
            <input type="text" name="nombre" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full border px-3 py-2 rounded"></textarea>
        </div>

        <div class="flex justify-between mt-4">
            <a href="{{ route('metas.index') }}" class="text-blue-600 hover:underline">⬅️ Volver</a>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">💾 Guardar</button>
        </div>
    </form>
</div>
@endsection
