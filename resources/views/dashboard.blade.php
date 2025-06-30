<x-app-layout>
    <div class="py-6 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600">Panel principal del sistema SIPeIP Reload</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                <!-- Módulo 1 -->
                <a href="{{ route('modulo1.dashboard') }}">
                    <x-dashboard-card 
                        color="blue" 
                        icon="fas fa-sitemap" 
                        title="Planificación Institucional" 
                        description="Definición de objetivos y metas" 
                    />
                </a>
                {{-- Módulo 2 --}}
                <a href="{{ route('modulo2.dashboard') }}">
                    <x-dashboard-card color="fuchsia" icon="fas fa-check-circle" title="Validación de Planes" description="Revisión técnica y normativa" />
                </a>

                {{-- Módulo 3 --}}
                <a href="{{ route('modulo3.dashboard') }}">
                    <x-dashboard-card color="green" icon="fas fa-project-diagram" title="Proyectos de Inversión" description="Gestión de proyectos registrados" />
                </a>

                {{-- Módulo 4 --}}
                <a href="{{ route('modulo4.dashboard') }}">
                    <x-dashboard-card color="yellow" icon="fas fa-tasks" title="Priorización y Viabilidad" description="Evaluación de factibilidad" />
                </a>

                {{-- Módulo 5 --}}
                <a href="{{ route('modulo5.dashboard') }}">
                    <x-dashboard-card color="purple" icon="fas fa-dollar-sign" title="Asignación Presupuestaria" description="Distribución de recursos" />
                </a>

                {{-- Módulo 6 --}}
                <a href="{{ route('modulo6.dashboard') }}">
                    <x-dashboard-card color="teal" icon="fas fa-chart-line" title="Ejecución y Seguimiento" description="Monitoreo del avance" />
                </a>

                {{-- Módulo 7 --}}
                <a href="{{ route('modulo7.dashboard') }}">
                    <x-dashboard-card color="orange" icon="fas fa-clipboard-check" title="Evaluación y Cierre" description="Informe final del proyecto" />
                </a>

                <!-- Módulo 8 -->
                <a href="{{ route('modulo8.dashboard') }}">
                    <x-dashboard-card color="red" icon="fas fa-user-shield" title="Administración y Seguridad" description="Gestión de usuarios y accesos" />
                </a>
            
            </div>
        </div>
    </div>
</x-app-layout>
