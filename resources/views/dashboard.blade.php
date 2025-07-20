<x-app-layout>
    <div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600">Panel principal del sistema SIPeIP Reload</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                {{-- Módulo 1 --}}
                @can('ver modulo planificación institucional')
                <a href="{{ route('modulo1.dashboard') }}">
                    <x-dashboard-card 
                        color="blue" 
                        icon="fas fa-sitemap" 
                        title="Planificación Institucional" 
                        description="Definición de objetivos y metas" 
                    />
                </a>
                @endcan

                {{-- Módulo 2 --}}
                @can('ver modulo validación de planes')
                <a href="{{ route('validaciones.index') }}">
                    <x-dashboard-card 
                        color="fuchsia" 
                        icon="fas fa-check-circle" 
                        title="Validación de Planes" 
                        description="Revisión técnica y normativa" 
                    />
                </a>
                @endcan

                {{-- Módulo 3 --}}
                @can('ver modulo proyectos')
                <a href="{{ route('modulo3.dashboard') }}">
                    <x-dashboard-card 
                        color="green" 
                        icon="fas fa-project-diagram" 
                        title="Proyectos de Inversión" 
                        description="Gestión de proyectos registrados" 
                    />
                </a>
                @endcan

                {{-- Módulo 4 --}}
                @can('ver modulo priorización y viabilidad')
                <a href="{{ route('modulo4.priorizacion.index') }}">
                    <x-dashboard-card 
                        color="yellow" 
                        icon="fas fa-tasks" 
                        title="Priorización y Viabilidad" 
                        description="Evaluación de factibilidad" 
                    />
                </a>
                @endcan

                {{-- Módulo 5 --}}
                @can('ver modulo asignación presupuestaria')
                <a href="{{ route('modulo5.dashboard') }}">
                    <x-dashboard-card 
                        color="purple" 
                        icon="fas fa-dollar-sign" 
                        title="Asignación Presupuestaria" 
                        description="Distribución de recursos" 
                    />
                </a>
                @endcan

                {{-- Módulo 6 --}}
                @can('ver modulo ejecución y seguimiento')
                <a href="{{ route('modulo6.dashboard') }}">
                    <x-dashboard-card 
                        color="teal" 
                        icon="fas fa-chart-line" 
                        title="Ejecución y Seguimiento" 
                        description="Monitoreo del avance" 
                    />
                </a>
                @endcan

                {{-- Módulo 7 --}}
                @can('ver modulo evaluación y cierre')
                <a href="{{ route('modulo7.dashboard') }}">
                    <x-dashboard-card 
                        color="orange" 
                        icon="fas fa-clipboard-check" 
                        title="Evaluación y Cierre" 
                        description="Informe final del proyecto" 
                    />
                </a>
                @endcan

                {{-- Módulo 8 --}}
                @can('ver modulo administración y seguridad')
                <a href="{{ route('modulo8.dashboard') }}">
                    <x-dashboard-card 
                        color="red" 
                        icon="fas fa-user-shield" 
                        title="Administración y Seguridad" 
                        description="Gestión de usuarios y accesos" 
                    />
                </a>
                @endcan

            </div>
        </div>
    </div>
</x-app-layout>
