<?php

namespace App\Http\Controllers\Modulo3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramaInversion;
use App\Models\PlanInstitucional;

class ProgramaInversionController extends Controller
{
    public function index()
    {
        $programas = ProgramaInversion::with('plan')->get();
        return view('modulo3.programas.index', compact('programas'));
    }

    public function create(Request $request)
    {
        $planId = $request->query('plan_id'); // Obtener de la URL
        $plan = PlanInstitucional::findOrFail($planId); // Obtener el plan

        return view('modulo3.programas.create', compact('plan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'nombre' => 'required|string|max:255',
        ]);

        ProgramaInversion::create([
            'plan_id' => $request->plan_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'sector' => $request->sector,
            'estado' => 'borrador',
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('programas.indexPorPlan', ['id' => $request->plan_id])->with('success', 'Programa creado.');

    }

    public function indexPorPlan($id)
    {
        $plan = PlanInstitucional::with('programas')->findOrFail($id);
        return view('modulo3.programas.index', compact('plan'));
    }
    // edit, update, show, destroy se completan después
    public function edit($id)
    {
        $programa = ProgramaInversion::findOrFail($id);
        return view('modulo3.programas.edit', compact('programa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'sector' => 'nullable|string',
        ]);

        $programa = ProgramaInversion::findOrFail($id);
        $programa->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'sector' => $request->sector,
        ]);

        return redirect()->route('programas.indexPorPlan', ['id' => $programa->plan_id])
                        ->with('success', 'Programa actualizado correctamente.');
    }

    public function destroy($id)
    {
        $programa = ProgramaInversion::findOrFail($id);
        $planId = $programa->plan_id;
        $programa->delete();

        return redirect()->route('programas.indexPorPlan', ['id' => $planId])
                        ->with('success', 'Programa eliminado correctamente.');
    }

}
