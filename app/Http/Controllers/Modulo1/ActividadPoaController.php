<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VersionHistorial;
use Illuminate\Support\Facades\Auth;
use App\Models\ActividadPoa;
use App\Models\PlanInstitucional;
use App\Models\ObjetivoEstrategico;
use App\Models\Meta;
use App\Models\User;

class ActividadPoaController extends Controller
{
    public function index()
    {
        $actividades = ActividadPoa::with(['plan', 'objetivoEstrategico', 'meta', 'responsable'])->get();
        return view('modulo1.actividades.index', compact('actividades'));
    }

    public function create()
    {
        $planes = PlanInstitucional::all();
        $objetivos = ObjetivoEstrategico::all();
        $metas = Meta::all();
        $responsables = User::all();

        return view('modulo1.actividades.create', compact('planes', 'objetivos', 'metas', 'responsables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required',
            'objetivo_estrategico_id' => 'required',
            'meta_id' => 'required',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'responsable_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'presupuesto_estimado' => 'required|numeric|min:0',
            'fuente_financiamiento' => 'nullable|string|max:255',
            'indicador_resultado' => 'nullable|string|max:255',
        ]);

        ActividadPoa::create($request->all());
        // Registro en el historial
        VersionHistorial::create([
            'plan_id' => $request->plan_id,
            'accion' => 'Registro de Actividad POA',
            'descripcion' => 'Se registró la actividad "' . $request->nombre . '" bajo la meta ID ' . $request->meta_id,
            'usuario_id' => Auth::id(),
            'fecha_accion' => now(),
        ]);

        return redirect()->route('actividades.index')->with('success', 'Actividad registrada correctamente.');
    }

    public function edit($id)
    {
        $actividad = ActividadPoa::findOrFail($id);
        $planes = PlanInstitucional::all();
        $objetivos = ObjetivoEstrategico::all();
        $metas = Meta::all();
        $responsables = User::all();

        return view('modulo1.actividades.edit', compact('actividad', 'planes', 'objetivos', 'metas', 'responsables'));
    }

    public function update(Request $request, $id)
    {
        $actividad = ActividadPoa::findOrFail($id);

        $request->validate([
            'plan_id' => 'required',
            'objetivo_estrategico_id' => 'required',
            'meta_id' => 'required',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'responsable_id' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'presupuesto_estimado' => 'required|numeric|min:0',
            'fuente_financiamiento' => 'nullable|string|max:255',
            'indicador_resultado' => 'nullable|string|max:255',
        ]);

        $actividad->update($request->all());

        return redirect()->route('actividades.index')->with('success', 'Actividad actualizada correctamente.');
    }

    public function destroy($id)
    {
        $actividad = ActividadPoa::findOrFail($id);
        $actividad->delete();

        return redirect()->route('actividades.index')->with('success', 'Actividad eliminada correctamente.');
    }
}
