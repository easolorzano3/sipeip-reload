@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
    <h2 class="text-2xl font-bold mb-4">📋 Evaluación y Cierre del Proyecto</h2>

    {{-- Tabs --}}
    <ul class="flex border-b mb-4">
        <li class="mr-4"><a href="#tab-tecnica" class="tab-link font-semibold text-blue-700">1. Evaluación Técnica</a></li>
        <li class="mr-4"><a href="#tab-conclusiones" class="tab-link text-gray-700">2. Conclusiones</a></li>
        <li class="mr-4"><a href="#tab-lecciones" class="tab-link text-gray-700">3. Lecciones</a></li>
        <li class="mr-4"><a href="#tab-informe" class="tab-link text-gray-700">4. Informe y Firma</a></li>
        <li><a href="#tab-cierre" class="tab-link text-gray-700">5. Cierre</a></li>
    </ul>

    {{-- Contenido de Tabs --}}
    <div id="tab-tecnica" class="tab-content">
        @include('modulo7.evaluacion.tabs.tecnica', [
            'proyecto' => $proyecto,
            'metas' => $metas,
            'avancesFisicos' => $avancesFisicos,
            'avancesFinancieros' => $avancesFinancieros
        ])
    </div>
    <div id="tab-conclusiones" class="tab-content hidden">@include('modulo7.evaluacion.tabs.conclusiones', ['proyecto' => $proyecto])</div>
    <div id="tab-lecciones" class="tab-content hidden">@include('modulo7.evaluacion.tabs.lecciones', ['proyecto' => $proyecto])</div>
    <div id="tab-informe" class="tab-content hidden">@include('modulo7.evaluacion.tabs.informe', ['proyecto' => $proyecto])</div>
    <div id="tab-cierre" class="tab-content hidden">@include('modulo7.evaluacion.tabs.cierre', ['proyecto' => $proyecto])</div>

</div>

<script>
    const links = document.querySelectorAll('.tab-link');
    const contents = document.querySelectorAll('.tab-content');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            contents.forEach(c => c.classList.add('hidden'));
            links.forEach(l => l.classList.remove('text-blue-700', 'font-semibold'));
            const tabId = link.getAttribute('href');
            document.querySelector(tabId).classList.remove('hidden');
            link.classList.add('text-blue-700', 'font-semibold');
        });
    });
</script>
@endsection
