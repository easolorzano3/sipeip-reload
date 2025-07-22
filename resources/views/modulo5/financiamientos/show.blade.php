@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">💰 Fuentes de Financiamiento Asignadas</h2>

    <p class="mb-2"><strong>Proyecto:</strong> {{ $proyecto->nombre }}</p>
    <p class="mb-2"><strong>Plan:</strong> {{ $proyecto->plan->nombre ?? '---' }}</p>

    {{-- BOTÓN DE GENERAR PDF --}}
    <div class="mb-6">
        <a href="{{ route('modulo5.proyectos.certificacion', $proyecto->id) }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            📄 Generar Certificación PDF
        </a>
    </div>

    <table class="table-auto w-full border mb-6">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Fuente</th>
                <th class="px-4 py-2">Descripcion</th>
                <th class="px-4 py-2">Tipo</th>
                <th class="px-4 py-2">Año</th>
                <th class="px-4 py-2">Monto Asignado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($financiamientos as $f)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $f->fuente->nombre }}</td>
                    <td class="px-4 py-2">{{ $f->fuente->descripcion }}</td>
                    <td class="px-4 py-2">{{ $f->fuente->tipo }}</td>
                    <td class="px-4 py-2">{{ $f->anio }}</td>
                    <td class="px-4 py-2">${{ number_format($f->monto, 2) }}</td>
                    <td class="px-4 py-2 whitespace-nowrap">
                        <a href="{{ route('financiamientos.edit', $f->id) }}" class="text-blue-600 hover:underline mr-2">Editar</a>

                        <form action="{{ route('financiamientos.destroy', $f->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Deseas eliminar este financiamiento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No hay asignaciones registradas.</td>
                </tr>
            @endforelse

            <tr class="border-t bg-gray-50 font-semibold">
                <td colspan="4" class="px-4 py-2 text-right">Total Asignado:</td>
                <td class="px-4 py-2 text-green-700">${{ number_format($total, 2) }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>

    {{-- NUEVA TABLA DE TECHOS PLURIANUALES --}}
    @if(isset($techos) && $techos->count() > 0)
        <h3 class="text-lg font-semibold mt-8 mb-2">📊 Techo Plurianual por Año</h3>

        <table class="table-auto w-full border mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Año</th>
                    <th class="px-4 py-2">Monto</th>
                </tr>
            </thead>
            <tbody>
                @foreach($techos as $techo)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $techo->anio }}</td>
                        <td class="px-4 py-2">${{ number_format($techo->monto, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('modulo5.dashboard') }}" class="text-blue-600 hover:underline">← Volver al módulo</a>
    @if($certificacionGenerada)
        <div class="mt-6">
            <form action="{{ route('financiamientos.enviarEsigef', $proyecto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block mb-2 font-semibold">📎 Subir Certificación Firmada (PDF)</label>
                <input type="file" name="archivo_firmado" accept="application/pdf" required class="mb-4">

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    📤 Enviar a eSIGEF
                </button>
            </form>
        </div>
    @endif
</div>
@endsection

