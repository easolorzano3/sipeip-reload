@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">
    <h2 class="text-2xl font-bold mb-6">📘 Submódulos disponibles del Módulo 1: Planificación Institucional</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('planes.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">📋</div>
            <div class="text-lg font-semibold">Planes Institucionales</div>
        </a>

        <a href="{{ route('objetivos.index') }}" class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">🎯</div>
            <div class="text-lg font-semibold">Objetivos Estratégicos</div>
        </a>

        <a href="{{ route('alineaciones-pnd-ods.index') }}">
            <div class="bg-indigo-600 text-white rounded-lg p-4 flex flex-col items-center justify-center hover:bg-indigo-700 cursor-pointer transition">
                <span class="text-3xl">🌍</span>
                <span class="text-sm mt-2 text-center font-semibold">Alineación PND / ODS</span>
            </div>
        </a>

        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">📈</div>
            <div class="text-lg font-semibold">Metas e Indicadores</div>
        </a>

        <a href="#" class="bg-pink-500 hover:bg-pink-600 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">📅</div>
            <div class="text-lg font-semibold">Actividades (POA)</div>
        </a>

        <a href="#" class="bg-rose-500 hover:bg-rose-600 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">🕒</div>
            <div class="text-lg font-semibold">Cronograma y Responsables</div>
        </a>

        <a href="#" class="bg-teal-600 hover:bg-teal-700 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">💵</div>
            <div class="text-lg font-semibold">Presupuesto por Actividad</div>
        </a>

        <a href="#" class="bg-slate-700 hover:bg-slate-800 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">📎</div>
            <div class="text-lg font-semibold">Documentos de Respaldo</div>
        </a>

        <a href="#" class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">📤</div>
            <div class="text-lg font-semibold">Envío a Revisión</div>
        </a>

        <a href="#" class="bg-gray-700 hover:bg-gray-800 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">🧾</div>
            <div class="text-lg font-semibold">Versiones e Historial</div>
        </a>

        <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white p-6 rounded-xl shadow text-center transition">
            <div class="text-4xl mb-2">🗂</div>
            <div class="text-lg font-semibold">Resoluciones y Publicación</div>
        </a>

    </div>
</div>
@endsection
