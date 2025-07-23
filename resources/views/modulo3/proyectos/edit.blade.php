@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">✏️ Editar Proyecto</h2>

    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block font-semibold">Plan Institucional</label>
                <p class="bg-gray-100 p-2 rounded">{{ $plan->nombre }}</p>
            </div>
            <div>
                <label class="block font-semibold">Programa</label>
                <p class="bg-gray-100 p-2 rounded">{{ $programa->nombre }}</p>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">Nombre del Proyecto</label>
                <input type="text" name="nombre" value="{{ old('nombre', $proyecto->nombre) }}" class="form-input w-full" required>
            </div>

            <div>
                <label class="block font-semibold">Actividad del POA (opcional)</label>
                <select name="actividad_poa_id" class="form-select w-full">
                    <option value="">-- Sin vínculo directo --</option>
                    @foreach($actividades as $actividad)
                        <option value="{{ $actividad->id }}" {{ $proyecto->actividad_poa_id == $actividad->id ? 'selected' : '' }}>
                            {{ $actividad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-semibold">Código del Proyecto</label>
                <input type="text" class="form-input w-full bg-gray-100" value="{{ $proyecto->codigo }}" readonly>
            </div>

            <div class="md:col-span-2">
                <label class="block font-semibold">Objetivo General</label>
                <textarea name="objetivo_general" rows="3" class="form-textarea w-full">{{ old('objetivo_general', $proyecto->objetivo_general) }}</textarea>
            </div>

            <div>
                <label class="block font-semibold">Monto Estimado ($)</label>
                <input type="number" step="0.01" name="monto_estimado" value="{{ old('monto_estimado', $proyecto->monto_estimado) }}" class="form-input w-full">
            </div>

            <div>
                <label class="block font-semibold">Cobertura</label>
                <input type="text" name="cobertura" value="{{ old('cobertura', $proyecto->cobertura) }}" class="form-input w-full" placeholder="Ej. Zona rural del cantón Milagro">
            </div>

            <div>
                <label class="block font-semibold">Inicio</label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}" class="form-input w-full">
            </div>

            <div>
                <label class="block font-semibold">Fin</label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $proyecto->fecha_fin) }}" class="form-input w-full">
            </div>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Metas asociadas</label>
            <select name="meta_ids[]" multiple class="w-full border rounded p-2">
                @foreach($metas as $meta)
                    <option value="{{ $meta->id }}" {{ in_array($meta->id, $proyecto->metas->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $meta->nombre }} - Obj: {{ $meta->objetivo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded shadow">
            💾 Actualizar Proyecto
        </button>
    </form>
</div>
@endsection
