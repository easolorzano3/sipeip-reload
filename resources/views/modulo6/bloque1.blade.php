<p class="mb-6 text-gray-600">
    Desde este módulo puedes gestionar los avances físicos y financieros de los proyectos de inversión pública registrados en tu institución.
</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Avance Financiero --}}
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2 text-gray-700">💰 Avance Financiero</h3>
        <p class="text-sm text-gray-500 mb-4">
            Registra y consulta los avances financieros por componente, responsable y fecha de corte.
        </p>
        <a href="{{ route('avance-financiero.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            Ver avances financieros
        </a>
    </div>

    {{-- Avance Físico --}}
    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
        <h3 class="text-lg font-semibold mb-2 text-gray-700">🏗️ Avance Físico</h3>
        <p class="text-sm text-gray-500 mb-4">
            Gestiona el progreso físico de las actividades planificadas por cada proyecto.
        </p>
        <a href="{{ route('avance-fisico.index') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
            Ver avances físicos
        </a>
    </div>
</div>

{{-- Visualizar Avances --}}
<div class="bg-white p-4 shadow rounded mt-6">
    <h3 class="text-lg font-semibold mb-2">🔍 Visualizar Avances de Proyecto</h3>
    <p class="text-sm text-gray-600 mb-2">Consulta todos los avances físicos y financieros registrados por proyecto.</p>

    <form id="formavance" method="GET">
        <div class="flex items-center gap-4">
            <select id="proyectoSelect" class="form-select border rounded px-2 py-1 w-full">
                <option value="">-- Selecciona un proyecto --</option>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->nombre }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>

            <button type="button" onclick="redirigirPorNombre()" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition">
                📋 Ver Avances
            </button>
        </div>
    </form>
</div>

{{-- Reporte PDF --}}
<div class="bg-white p-4 shadow rounded mt-6">
    <h3 class="text-lg font-semibold mb-2">📝 Reporte de Avances por Proyecto</h3>
    <p class="text-sm text-gray-600 mb-4">Genera un reporte filtrando por proyecto y rango de fechas.</p>

    <form action="{{ route('reporte-avances.generar-pdf') }}" method="GET" target="_blank" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="text-sm font-semibold">Proyecto:</label>
            <select name="proyecto_id" class="form-select border rounded px-2 py-1 w-full" required>
                <option value="">-- Selecciona un proyecto --</option>
                @foreach ($proyectos as $proyecto)
                    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-semibold">Desde:</label>
            <input type="date" name="desde" class="form-input border rounded px-2 py-1 w-full" required>
        </div>

        <div>
            <label class="text-sm font-semibold">Hasta:</label>
            <input type="date" name="hasta" class="form-input border rounded px-2 py-1 w-full" required>
        </div>

        <div class="md:col-span-3 text-right mt-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 text-sm">
                🖨️ Generar PDF
            </button>
        </div>
    </form>
</div>

{{-- Script para redirigir por nombre --}}
<script>
    function redirigirPorNombre() {
        const nombre = document.getElementById('proyectoSelect').value;
        if (nombre) {
            window.location.href = `/modulo6/proyectos/nombre/${encodeURIComponent(nombre)}`;
        }
    }
</script>
