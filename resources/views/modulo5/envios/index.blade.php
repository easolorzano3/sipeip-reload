@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-xl font-bold mb-4">📤 Envíos Simulados al eSIGEF</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2">Proyecto</th>
                <th class="px-4 py-2">Certificación</th>
                <th class="px-4 py-2">Respuesta</th>
                <th class="px-4 py-2">Observaciones</th>
                <th class="px-4 py-2">Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse($envios as $envio)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $envio->proyecto->nombre }}</td>
                    <td class="px-4 py-2">
                        <a href="{{ asset('storage/' . $envio->archivo_certificacion) }}" target="_blank" class="text-blue-600 hover:underline">
                            Ver PDF
                        </a>
                    </td>
                    <td class="px-4 py-2">
                        @if($envio->respuesta_sistema === 'aprobado')
                            <span class="text-green-600 font-semibold">✔ Aprobado</span>
                        @else
                            <span class="text-red-600 font-semibold">✘ Rechazado</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">{{ $envio->observaciones ?? '---' }}</td>
                    <td class="px-4 py-2">{{ $envio->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No hay envíos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('modulo5.dashboard') }}" class="text-blue-600 hover:underline">← Volver al Módulo</a>
    </div>
</div>
@endsection
