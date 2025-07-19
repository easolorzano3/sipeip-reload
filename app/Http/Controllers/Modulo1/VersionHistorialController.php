<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VersionHistorial;
use App\Models\PlanInstitucional;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;

class VersionHistorialController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el ID del plan enviado por la URL (GET), o tomar el más reciente si no hay
        $planId = $request->get('plan_id') ?? PlanInstitucional::latest()->first()?->id;

        // Buscar el plan actual seleccionado
        $plan = PlanInstitucional::find($planId);

        // Consultar las versiones de ese plan
        $versiones = VersionHistorial::with(['plan', 'usuario'])
            ->where('plan_id', $planId)
            ->orderByDesc('fecha_accion')
            ->get();

        // Obtener todos los planes para mostrar en el selector
        $todosLosPlanes = PlanInstitucional::orderBy('created_at', 'desc')->get();

        return view('modulo1.versiones.index', compact('versiones', 'plan', 'todosLosPlanes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'accion' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        VersionHistorial::create([
            'plan_id' => $request->plan_id,
            'accion' => $request->accion,
            'descripcion' => $request->descripcion,
            'usuario_id' => Auth::id(),
            'fecha_accion' => now(),
        ]);

        return back()->with('success', 'Acción registrada correctamente en el historial.');
    }

    public function generarPDF($plan_id)
    {
        $plan = PlanInstitucional::findOrFail($plan_id);
        $versiones = VersionHistorial::where('plan_id', $plan_id)
            ->with('usuario')
            ->orderBy('fecha_accion', 'desc')
            ->get();

        $pdf = PDF::loadView('modulo1.versiones.reporte', compact('plan', 'versiones'));
        return $pdf->download('Historial_Versiones_Plan_' . $plan->id . '.pdf');
    }
}
