@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-bold mb-4">📘 Evaluación Final y Cierre - Planes Publicados</h2>

    {{-- ✅ Mensaje de éxito --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($planes->isEmpty())
        <p class="text-gray-600">No se encontraron planes con los criterios especificados.</p>
    @else
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Nombre del Plan</th>
                    <th class="px-4 py-2 border">Estado</th>
                    <th class="px-4 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planes as $index => $plan)
                <tr>
                    <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 border">{{ $plan->nombre }}</td>
                    <td class="px-4 py-2 border">{{ $plan->estado->nombre ?? 'Desconocido' }}</td>
                    <td class="px-4 py-2 border text-center">
                        <form action="{{ route('modulo7.finalizar', $plan->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de finalizar este plan?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                Finalizar Plan
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
