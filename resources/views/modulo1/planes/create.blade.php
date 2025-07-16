@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">➕ Registrar Plan Institucional</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('planes.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- DATOS DE LA ENTIDAD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-sm text-gray-700">Entidad</label>
                <input type="text" name="entidad" required class="w-full rounded border-gray-300 mt-1" placeholder="Ej: Ministerio de Educación" value="{{ old('entidad') }}">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Nivel de Gobierno</label>
                <select name="nivel" required class="w-full rounded border-gray-300 mt-1">
                    <option value="">Seleccione</option>
                    <option value="Nacional" {{ old('nivel') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                    <option value="Zonal" {{ old('nivel') == 'Zonal' ? 'selected' : '' }}>Zonal</option>
                    <option value="Provincial" {{ old('nivel') == 'Provincial' ? 'selected' : '' }}>Provincial</option>
                    <option value="Cantonal" {{ old('nivel') == 'Cantonal' ? 'selected' : '' }}>Cantonal</option>
                </select>
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Código Institucional</label>
                <input type="text" name="codigo_institucional" required class="w-full rounded border-gray-300 mt-1" placeholder="Ej: MINEDUC01" value="{{ old('codigo_institucional') }}">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Estado Institucional</label>
                <select name="estado_institucion" required class="w-full rounded border-gray-300 mt-1">
                    <option value="">Seleccione</option>
                    <option value="Activo" {{ old('estado_institucion') == 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado_institucion') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
        </div>

        {{-- DATOS DEL PLAN --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-medium text-sm text-gray-700">Nombre del Plan</label>
                <input type="text" name="nombre" required class="w-full rounded border-gray-300 mt-1" placeholder="Ej: Plan Estratégico Institucional 2024-2028" value="{{ old('nombre') }}">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Código del Plan (opcional)</label>
                <input type="text" name="codigo" class="w-full rounded border-gray-300 mt-1" placeholder="Ej: PEI2024" value="{{ old('codigo') }}">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Año de Inicio</label>
                <input type="date" name="anio_inicio" min="2020" required class="w-full rounded border-gray-300 mt-1" value="{{ old('periodo_inicio') }}">
            </div>

            <div>
                <label class="block font-medium text-sm text-gray-700">Año de Fin</label>
                <input type="date" name="anio_fin" min="2020" required class="w-full rounded border-gray-300 mt-1" value="{{ old('periodo_fin') }}">
            </div>
        </div>

        {{-- UNIDADES EJECUTORAS --}}
        <div>
            <label class="block font-medium text-sm text-gray-700 mb-2">Unidades Ejecutoras</label>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                @foreach ($unidades as $unidad)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="unidades[]" value="{{ $unidad->id }}" class="mr-2">
                        {{ $unidad->nombre }}
                    </label>
                @endforeach
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Guardar Plan
            </button>
        </div>
    </form>
</div>
@endsection
