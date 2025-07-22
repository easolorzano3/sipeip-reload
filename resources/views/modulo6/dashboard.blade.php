@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">📊 Módulo 6 - Ejecución y Seguimiento</h2>

    <div class="border-b border-gray-200 mb-4">
        <nav class="-mb-px flex space-x-8" id="tabs" role="tablist">
            <button class="tab-link text-gray-500 hover:text-indigo-600 px-4 py-2 font-medium border-b-2 border-transparent hover:border-indigo-500" onclick="mostrarTab('tab1')">📊 Ejecución y Monitoreo</button>
            <button class="tab-link text-gray-500 hover:text-indigo-600 px-4 py-2 font-medium border-b-2 border-transparent hover:border-indigo-500" onclick="mostrarTab('tab2')">📁 Gestión Documental</button>
            <button class="tab-link text-gray-500 hover:text-indigo-600 px-4 py-2 font-medium border-b-2 border-transparent hover:border-indigo-500" onclick="mostrarTab('tab3')">📅 Planificación Ejecutiva</button>
            <button class="tab-link text-gray-500 hover:text-indigo-600 px-4 py-2 font-medium border-b-2 border-transparent hover:border-indigo-500" onclick="mostrarTab('tab4')">📄 Reportes y Contratación</button>
        </nav>
    </div>

    <div>
        {{-- BLOQUE 1 --}}
        <div id="tab1" class="tab-content">
            @include('modulo6.bloque1')
        </div>

        {{-- BLOQUE 2 --}}
        <div id="tab2" class="tab-content hidden">
            @include('modulo6.bloque2')
        </div>

        {{-- BLOQUE 3 --}}
        <div id="tab3" class="tab-content hidden">
            @include('modulo6.bloque3')
        </div>

        {{-- BLOQUE 4 --}}
        <div id="tab4" class="tab-content hidden">
            @include('modulo6.bloque4')
        </div>
    </div>
</div>

<script>
    function mostrarTab(tabId) {
        document.querySelectorAll('.tab-content').forEach(div => div.classList.add('hidden'));
        document.querySelectorAll('.tab-link').forEach(tab => tab.classList.remove('border-indigo-600', 'text-indigo-600'));
        document.getElementById(tabId).classList.remove('hidden');
        event.target.classList.add('border-indigo-600', 'text-indigo-600');
    }

    window.addEventListener('DOMContentLoaded', () => mostrarTab('tab1'));
</script>
@endsection
