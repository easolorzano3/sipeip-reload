@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-6">➕ Registrar Nueva Actividad POA</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('actividades.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Plan</label>
                <select name="plan_id" class="w-full border rounded p-2" required>
                    <option value="">Seleccione</option>
                    @foreach($planes as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->nombre ?? 'Plan ID '.$plan->id }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Objetivo Estratégico</label>
                <select name="objetivo_estrategico_id" class="w-full border rounded p-2" required>
                    <option value="">Seleccione</option>
                    @foreach($objetivos as $obj)
                        <option value="{{ $obj->id }}">{{ $obj->nombre ?? 'Objetivo '.$obj->id }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Meta Asociada</label>
                <select name="meta_id" class="w-full border rounded p-2" required>
                    <option value="">Seleccione</option>
                    @foreach($metas as $meta)
                        <option value="{{ $meta->id }}">{{ $meta->nombre ?? 'Meta '.$meta->id }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Responsable</label>
                <select name="responsable_id" class="w-full border rounded p-2" required>
                    <option value="">Seleccione</option>
                    @foreach($responsables as $user)
                        <option value="{{ $user->id }}">{{ $user->nombres }} {{ $user->apellidos }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Nombre de la Actividad</label>
            <input type="text" name="nombre" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Descripción</label>
            <textarea name="descripcion" rows="3" class="w-full border rounded p-2"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Fecha de Inicio</label>
                <input type="date" name="fecha_inicio" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Fecha de Fin</label>
                <input type="date" name="fecha_fin" class="w-full border rounded p-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Presupuesto Estimado ($)</label>
                <input type="number" name="presupuesto_estimado" step="0.01" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Fuente de Financiamiento</label>
                <input type="text" name="fuente_financiamiento" class="w-full border rounded p-2">
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Indicador de Resultado</label>
            <input type="text" name="indicador_resultado" class="w-full border rounded p-2">
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('actividades.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Cancelar</a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Guardar</button>
        </div>
    </form>
</div>
@endsection
