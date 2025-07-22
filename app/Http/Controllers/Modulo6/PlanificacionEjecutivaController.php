<?php

namespace App\Http\Controllers\Modulo6;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PlanificacionEjecutiva;
use App\Models\ProyectoInversion;
use Illuminate\Support\Facades\Auth;

class PlanificacionEjecutivaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'hito' => 'required|string|max:255',
            'fecha' => 'required|date',
            'responsable' => 'nullable|string|max:255',
            'observacion' => 'nullable|string',
        ]);

        PlanificacionEjecutiva::create([
            'proyecto_id' => $request->proyecto_id,
            'hito' => $request->hito,
            'fecha' => $request->fecha,
            'responsable' => $request->responsable,
            'observacion' => $request->observacion,
            'user_id' => auth()->id(),
            
        ]);

        return back()->with('success', 'Hito registrado correctamente.');
    }

    public function index()
    {
        $planificaciones = PlanificacionEjecutiva::with(['proyecto', 'usuario'])->latest()->get();
        return view('modulo6.bloque3', compact('planificaciones'));
    }

    public function destroy($id)
    {
        $planificacion = PlanificacionEjecutiva::findOrFail($id);
        $planificacion->delete();

        return redirect()->back()->with('success', 'Hito eliminado correctamente.');
    }


}
