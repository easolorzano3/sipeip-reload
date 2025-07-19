<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnvioRevision;
use App\Models\EstadoPlan;
use App\Models\PlanInstitucional;
use Carbon\Carbon;

class EnvioRevisionController extends Controller
{
    public function index()
    {
        $envios = EnvioRevision::with('plan')->get();
        return view('modulo1.revision.index', compact('envios'));
    }

    public function create()
    {
        $planes = PlanInstitucional::all();
        return view('modulo1.revision.create', compact('planes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'observaciones' => 'nullable|string|max:1000',
        ]);

        EnvioRevision::create([
            'plan_id' => $request->plan_id,
            'observaciones' => $request->observaciones,
            'fecha_envio' => Carbon::now(),
            'estado_envio' => 'enviado', //nuevo campo para mostrar correctamente el estado
        ]);
        
        // Cambiar estado del plan a "enviado"
        $estadoEnviado = EstadoPlan::where('nombre', 'enviado')->first();
        if ($estadoEnviado) {
            $plan = PlanInstitucional::findOrFail($request->plan_id);
            $plan->estado_id = $estadoEnviado->id;
            $plan->save();
        }
        return redirect()->route('revision.index')->with('success', 'Plan enviado para revisión.');
    }

    public function edit($id)
    {
        $envio = EnvioRevision::findOrFail($id);
        $planes = PlanInstitucional::all();
        return view('modulo1.revision.edit', compact('envio', 'planes'));
    }

    public function update(Request $request, $id)
    {
        $envio = EnvioRevision::findOrFail($id);

        $request->validate([
            'estado_envio' => 'required|string',
            'respuesta' => 'nullable|string|max:1000',
            'fecha_respuesta' => 'nullable|date',
        ]);

        $envio->update([
            'estado_envio' => $request->estado_envio,
            'respuesta' => $request->respuesta,
            'fecha_respuesta' => $request->fecha_respuesta ?? now(),
        ]);

        // Actualizar estado del plan según revisión
        $estadoNuevo = EstadoPlan::where('nombre', strtolower($request->estado_envio))->first();
        if ($estadoNuevo) {
            $plan = PlanInstitucional::findOrFail($envio->plan_id);
            $plan->estado_id = $estadoNuevo->id;
            $plan->save();
        }
                return redirect()->route('revision.index')->with('success', 'Estado de revisión actualizado.');
    }

    public function destroy($id)
    {
        EnvioRevision::findOrFail($id)->delete();

        return redirect()->route('revision.index')->with('success', 'Registro eliminado correctamente.');
    }
}
