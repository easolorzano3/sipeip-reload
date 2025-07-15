@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <h2 class="text-2xl font-bold mb-6">✏️ Editar Plan Institucional</h2>

    <form action="{{ route('planes.update', $plan->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Entidad</label>
            <input type="text" name="entidad" value="{{ old('entidad', $plan->entidad) }}" class="w-full p-2 border rounded" required>
        </div>

        <div>
            <label class="block font-medium">Nivel</label>
            <input type="text" name="nivel" value="{{ old('nivel', $plan->nivel) }}" class="w-full p-2 border rounded" required>
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
            <input type="text" name="codigo" value="{{ old('codigo', $plan->codigo) }}" class="w-full p-2 border rounded">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Año de Inicio</label>
                <input type="number" name="periodo_inicio" value="{{ old('periodo_inicio', $plan->periodo_inicio) }}" class="w-full p-2 border rounded" required>
            </div>
            <div>
                <label class="block font-medium">Año de Fin</label>
                <input type="number" name="periodo_fin" value="{{ old('periodo_fin', $plan->periodo_fin) }}" class="w-full p-2 border rounded" required>
            </div>
        </div>

        <div>
            <label class="block font-medium">Estado Institución</label>
            <select name="estado_institucion" class="w-full p-2 border rounded" required>
                <option value="Activo" {{ $plan->estado_institucion == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $plan->estado_institucion == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
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
