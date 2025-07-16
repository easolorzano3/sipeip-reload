<x-app-layout>
    <div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">➕ Registrar Objetivo Estratégico</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('objetivos.store') }}" method="POST">
                @csrf

                {{-- Plan institucional --}}
                <div class="mb-4">
                    <label for="plan_institucional_id" class="block text-sm font-medium text-gray-700">Plan Institucional *</label>
                    <select name="plan_institucional_id" id="plan_institucional_id" class="w-full mt-1 p-2 border rounded" required>
                        <option value="">-- Selecciona un plan --</option>
                        @foreach($planes as $plan)
                            <option value="{{ $plan->id }}" {{ old('plan_institucional_id') == $plan->id ? 'selected' : '' }}>
                                {{ $plan->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Objetivo *</label>
                    <input type="text" name="nombre" id="nombre" class="w-full mt-1 p-2 border rounded" value="{{ old('nombre') }}" required>
                </div>

                {{-- Descripción --}}
                <div class="mb-4">
                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción *</label>
                    <textarea name="descripcion" id="descripcion" class="w-full mt-1 p-2 border rounded" rows="3" required>{{ old('descripcion') }}</textarea>
                </div>

                {{-- Eje estratégico --}}
                <div class="mb-4">
                    <label for="eje_estrategico_id" class="block text-sm font-medium text-gray-700">Eje Estratégico *</label>
                    <select name="eje_estrategico_id" id="eje_estrategico_id" class="w-full mt-1 p-2 border rounded" required>
                        <option value="">-- Selecciona un eje --</option>
                        @foreach($ejes as $eje)
                            <option value="{{ $eje->id }}" {{ old('eje_estrategico_id') == $eje->id ? 'selected' : '' }}>
                                {{ $eje->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Política Nacional (opcional) --}}
                <div class="mb-4">
                    <label for="politica_nacional_id" class="block text-sm font-medium text-gray-700">Política Nacional (opcional)</label>
                    <select name="politica_nacional_id" id="politica_nacional_id" class="w-full mt-1 p-2 border rounded">
                        <option value="">-- Sin asignar --</option>
                        @foreach($politicas as $politica)
                            <option value="{{ $politica->id }}" {{ old('politica_nacional_id') == $politica->id ? 'selected' : '' }}>
                                {{ $politica->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Periodo de ejecución --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="periodo_inicio" class="block text-sm font-medium text-gray-700">Año de Inicio *</label>
                        <input type="date" name="periodo_inicio" id="periodo_inicio" class="w-full mt-1 p-2 border rounded" value="{{ old('periodo_inicio') }}" required>
                    </div>
                    <div>
                        <label for="periodo_fin" class="block text-sm font-medium text-gray-700">Año de Fin *</label>
                        <input type="date" name="periodo_fin" id="periodo_fin" class="w-full mt-1 p-2 border rounded" value="{{ old('periodo_fin') }}" required>
                    </div>
                </div>

                {{-- Estado --}}
                <div class="mb-4">
                    <label for="estado" class="block text-sm font-medium text-gray-700">Estado *</label>
                    <select name="estado" id="estado" class="w-full mt-1 p-2 border rounded" required>
                        <option value="">-- Selecciona un estado --</option>
                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                {{-- Botones --}}
                <div class="flex justify-end mt-6">
                    <a href="{{ route('objetivos.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancelar</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
