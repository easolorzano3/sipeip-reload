@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📋 Proyectos Viables para Asignación</h2>

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Plan</th>
                <th class="px-4 py-2">Programa</th>
                <th class="px-4 py-2">Código</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Entidad</th>
                <th class="px-4 py-2">Monto Estimado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $proyecto)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        {{ $proyecto->plan?->nombre ?? '---' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $proyecto->programa?->nombre ?? '---' }}
                    </td>
                    <td class="px-4 py-2">{{ $proyecto->codigo }}</td>
                    <td class="px-4 py-2">{{ $proyecto->nombre }}</td>
                    <td class="px-4 py-2">{{ $proyecto->plan->entidad ?? '---' }}</td>
                    <td class="px-4 py-2">${{ number_format($proyecto->monto_estimado, 2) }}</td>
                    <td class="px-4 py-2 space-y-1">
                        <a href="{{ route('techos.create', $proyecto->id) }}"
                           class="block bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded">
                            📊 Asignar Techo Plurianual
                        </a>
                        <a href="{{ route('financiamientos.create', $proyecto->id) }}"
                           class="block bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1 rounded">
                            💰 Asignar Fuentes de Financiamiento
                        </a>
                        <a href="{{ route('financiamientos.show', $proyecto->id) }}" class="text-indigo-600 hover:underline ml-2">🔍 Ver Financiamiento</a>
                        @if (Storage::disk('public')->exists('certificaciones/certificacion_presupuestaria_' . $proyecto->codigo . '.pdf'))
                            <a href="{{ route('esigef.formulario', $proyecto->id) }}"
                            class="block bg-yellow-600 hover:bg-yellow-700 text-white text-sm px-3 py-1 rounded mt-1">
                                📤 Enviar a eSIGEF
                            </a>
                            <a href="{{ route('envios-sigef.index') }}"
                                class="block bg-purple-600 hover:bg-purple-700 text-white text-sm px-3 py-1 rounded mt-1">
                                📄 Ver Envíos a eSIGEF
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No hay proyectos viables disponibles.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
