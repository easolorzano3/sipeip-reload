<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use App\Models\Resolucion;
use App\Models\PlanInstitucional;
use App\Models\EstadoPlan;
use Illuminate\Http\Request;

class ResolucionController extends Controller
{

    public function index()
    {
        $resoluciones = Resolucion::with(['plan', 'usuario'])->latest()->get();
        return view('modulo1.resoluciones.index', compact('resoluciones'));
    }

    // Mostrar formulario para seleccionar plan y publicar resolución
    public function create()
    {
        $estadoAprobado = EstadoPlan::where('nombre', 'aprobado')->first();

        $planes = PlanInstitucional::where('estado_id', $estadoAprobado->id)->get();

        return view('modulo1.resoluciones.create', compact('planes'));
    }

    // Guardar resolución y actualizar el estado del plan a "Publicado"
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'numero' => 'required|string|max:255',
            'fecha' => 'required|date',
            'archivo' => 'required|mimes:pdf|max:10240',
        ]);

        try {
            $archivo = $request->file('archivo')->store('resoluciones', 'public');

            Resolucion::create([
                'plan_id' => $request->plan_id,
                'numero' => $request->numero,
                'fecha' => $request->fecha,
                'archivo' => $archivo,
                'user_id' => auth()->id(),
            ]);

            // Cambiar estado del plan a "Publicado"
            $estadoPublicado = EstadoPlan::where('nombre', 'publicado')->first();
            if ($estadoPublicado) {
                $plan = PlanInstitucional::find($request->plan_id);
                $plan->estado_id = $estadoPublicado->id;
                $plan->save();
            }

            return redirect()->route('resoluciones.index')->with('success', 'Resolución publicada y plan actualizado.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al guardar la resolución: ' . $e->getMessage()]);
        }
    }

}