<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard del Módulo 3 - Gestión de Proyectos de Inversión Pública') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <p class="text-lg font-medium text-gray-700 mb-4">
                    Bienvenido al módulo 3: Gestión de Proyectos de Inversión Pública.
                </p>

                @if($planes->count())
                    @foreach($planes as $plan)
                        <div class="bg-gray-50 p-4 rounded mb-4 border">
                            <p><strong>📄 Plan institucional:</strong> {{ $plan->nombre }}</p>
                            <p><strong>📌 Estado:</strong> {{ optional($plan->estado)->nombre ?? 'Publicado' }}</p>
                            <a href="{{ route('programas.indexPorPlan', $plan->id) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded">
                                    Ingresar a Programas y Proyectos
                            </a>

                            
                        </div>
                    @endforeach
                @else
                    <div class="mt-4 text-red-600 font-semibold">
                        🚫 No tienes planes institucionales publicados que requieran inversión pública.
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
