<?php

namespace App\Http\Controllers\Modulo2;

use App\Http\Controllers\Controller;
use App\Models\PlanInstitucional;
use App\Models\EstadoPlan;
use Illuminate\Http\Request;

class ValidacionPlanController extends Controller
{
    public function index()
    {
        $planes = PlanInstitucional::with('estado')
            ->whereHas('estado', function ($q) {
                $q->where('nombre', 'enviado');
            })->get();

        return view('modulo2.validaciones.index', compact('planes'));
    }

    public function edit($id)
    {
        $plan = PlanInstitucional::findOrFail($id);
        $estados = EstadoPlan::whereIn('nombre', ['aprobado', 'observado', 'rechazado'])->get();

        return view('modulo2.validaciones.edit', compact('plan', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado_id' => 'required|exists:estado_plans,id',
        ]);

        $plan = PlanInstitucional::findOrFail($id);
        $plan->estado_id = $request->estado_id;
        $plan->save();

        return redirect()->route('validaciones.index')->with('success', 'Estado del plan actualizado correctamente.');
    }
}
