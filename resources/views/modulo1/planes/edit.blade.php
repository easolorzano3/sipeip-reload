@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6">✏️ Editar Plan Institucional</h2>
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
            <strong>¡Ups! Algo salió mal.</strong>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('planes.update', $plan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Entidad</label>
            <input type="text" name="entidad" value="{{ old('entidad', $plan->entidad) }}" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-medium">Nivel de Gobierno</label>
            <select name="nivel_gobierno" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Nacional" @selected(old('nivel_gobierno', $plan->nivel_gobierno ?? '') == 'Nacional')>Nacional</option>
                <option value="Zonal" @selected(old('nivel_gobierno', $plan->nivel_gobierno ?? '') == 'Zonal')>Zonal</option>
                <option value="Provincial" @selected(old('nivel_gobierno', $plan->nivel_gobierno ?? '') == 'Provincial')>Provincial</option>
                <option value="Cantonal" @selected(old('nivel_gobierno', $plan->nivel_gobierno ?? '') == 'Cantonal')>Cantonal</option>
                <option value="Autónomo Descentralizado" @selected(old('nivel_gobierno', $plan->nivel_gobierno ?? '') == 'Autónomo Descentralizado')>Autónomo Descentralizado</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Código institucional</label>
            <input type="text" name="codigo_institucional" value="{{ old('codigo_institucional', $plan->codigo_institucional) }}" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-medium">Nombre del Plan</label>
            <input type="text" name="nombre" value="{{ old('nombre', $plan->nombre) }}" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-medium">Código (opcional)</label>
            <input type="text" name="codigo_plan" value="{{ old('codigo_plan', $plan->codigo_plan) }}" class="w-full p-2 border rounded">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Año de Inicio</label>
                <input type="date" name="anio_inicio" value="{{ old('anio_inicio', $plan->anio_inicio) }}" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-medium">Año de Fin</label>
                <input type="date" name="anio_fin" value="{{ old('anio_fin', $plan->anio_fin) }}" class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div>
            <label class="block font-medium">Estado Institución</label>
            <select name="estado_institucional" class="form-select" required>
                <option value="">Seleccione</option>
                <option value="Activo" @selected(old('estado_institucional', $plan->estado_institucional ?? '') == 'Activo')>Activo</option>
                <option value="Inactivo" @selected(old('estado_institucional', $plan->estado_institucional ?? '') == 'Inactivo')>Inactivo</option>
                <option value="Evaluacion" @selected(old('estado_institucional', $plan->estado_institucional ?? '') == 'Evaluacion')>Evaluacion</option>
                <option value="Reestructuracion" @selected(old('estado_institucional', $plan->estado_institucional ?? '') == 'Reestructuracion')>Reestructuracion</option>
                <option value="Suprimido" @selected(old('estado_institucional', $plan->estado_institucional ?? '') == 'Suprimido')>Suprimido</option>
            </select>
        </div>

        {{-- ✅ NUEVO: Checkboxes de unidades ejecutoras --}}
        <div>
            <label class="block font-medium mb-2">Unidades Ejecutoras</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($unidades as $unidad)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="unidades[]" value="{{ $unidad->id }}"
                            {{ in_array($unidad->id, $unidadesSeleccionadas) ? 'checked' : '' }}
                            class="form-checkbox text-blue-600">
                        <span class="ml-2">{{ $unidad->nombre }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                💾 Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection
