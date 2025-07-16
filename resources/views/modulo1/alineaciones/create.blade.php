@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">➕ Registrar Alineación PND / ODS</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alineaciones-pnd-ods.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Objetivo Estratégico <span class="text-red-600">*</span></label>
                <select name="objetivo_estrategico_id" required class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">Seleccione...</option>
                    @foreach($objetivos as $item)
                        <option value="{{ $item->id }}" {{ old('objetivo_estrategico_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Objetivo PND</label>
                <select name="pnd_id" class="form-select">
                    <option value="" selected disabled>Seleccione...</option>
                    @foreach($pnd as $objetivo)
                        <option value="{{ $objetivo->id }}">
                            {{ $objetivo->codigo }} - [{{ $objetivo->eje }}] - {{ $objetivo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Objetivo ODS</label>
                <select name="ods_id" class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">Seleccione...</option>
                    @foreach($ods as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->codigo }} - {{ $item->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Indicador</label>
                <input type="text" name="indicador" value="{{ old('indicador') }}" class="w-full border border-gray-300 rounded px-3 py-2">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Justificación</label>
            <textarea name="justificacion" rows="3" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('justificacion') }}</textarea>
        </div>

        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('alineaciones-pnd-ods.index') }}" class="text-blue-600 hover:underline">⬅️ Volver al listado</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                💾 Guardar
            </button>
        </div>
    </form>
</div>
@endsection
