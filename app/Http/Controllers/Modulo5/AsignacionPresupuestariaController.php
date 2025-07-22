<?php

namespace App\Http\Controllers\Modulo5;

use App\Http\Controllers\Controller;
use App\Models\ProyectoInversion;
use Illuminate\Http\Request;

class AsignacionPresupuestariaController extends Controller
{
    public function index()
    {
        $proyectos = ProyectoInversion::whereHas('dictamenTecnico', function ($q) {
                $q->where('estado_dictamen', 'aprobado');
            })
            ->doesntHave('asignacionPresupuestaria')
            ->with(['programa.plan', 'plan'])
            ->get();

        return view('modulo5.dashboard', compact('proyectos'));
    }
}
