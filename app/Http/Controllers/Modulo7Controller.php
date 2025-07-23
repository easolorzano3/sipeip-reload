<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlanInstitucional;

class Modulo7Controller extends Controller
{
    public function index()
    {
        $planes = PlanInstitucional::with(['estado', 'proyectos.dictamenTecnico'])
            ->where('estado_id', 6) // publicado
            ->whereHas('proyectos.dictamenTecnico', function ($query) {
                $query->where('estado_dictamen', 'aprobado');
            })
            ->get();

        return view('modulo7.dashboard', compact('planes'));
    }

    public function show($id)
    {
        $plan = PlanInstitucional::with(['proyectos.lecciones', 'proyectos.informeFirmado'])->findOrFail($id);
        $proyecto = $plan->proyectos->first();
        $lecciones = $proyecto ? $proyecto->lecciones : collect();

        // Si todavía no tienes datos, puedes usar collect() como placeholder
        $metas = collect();
        $conclusiones = collect();
        $informe = $proyecto ? $proyecto->informeFirmado : null;
        $cierres = collect();
        $avancesFisicos = collect();
        $avancesFinancieros = collect();

        return view('modulo7.evaluacion.show', compact(
            'plan',
            'proyecto',
            'lecciones',
            'metas',
            'conclusiones',
            'informe',
            'cierres',
            'avancesFisicos',
            'avancesFinancieros'
        ));
    }

}