<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use App\Models\ObjetivoEstrategico;
use App\Models\PlanInstitucional;
use App\Models\EjeEstrategico;
use App\Models\PoliticaNacional;
use Illuminate\Http\Request;

class ObjetivoEstrategicoController extends Controller
{
    public function index()
    {
        $objetivos = ObjetivoEstrategico::with(['planInstitucional', 'ejeEstrategico', 'politicaNacional'])->get();
        return view('modulo1.objetivos.index', compact('objetivos'));
    }

    public function create()
    {
        $planes = PlanInstitucional::all();
        $ejes = EjeEstrategico::all();
        $politicas = PoliticaNacional::all();

        return view('modulo1.objetivos.create', compact('planes', 'ejes', 'politicas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_institucional_id' => 'required|exists:plan_institucionales,id',
            'nombre' => 'required|max:200',
            'descripcion' => 'required',
            'eje_estrategico_nombre' => 'nullable|string|max:200',
            'politica_nacional_nombre' => 'nullable|string|max:200',
            'periodo_inicio' => 'required|date',
            'periodo_fin' => 'required|date|after_or_equal:periodo_inicio',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        ObjetivoEstrategico::create([
            'plan_institucional_id' => $request->plan_institucional_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'eje_estrategico_nombre' => $request->eje_estrategico_nombre,
            'politica_nacional_nombre' => $request->politica_nacional_nombre,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin' => $request->periodo_fin,
            'estado' => $request->estado,
        ]);

        return redirect()->route('objetivos.index')->with('success', 'Objetivo registrado correctamente.');
    }

    public function edit($id)
    {
        $objetivo = ObjetivoEstrategico::findOrFail($id);
        $planes = PlanInstitucional::all();
        $ejes = EjeEstrategico::all();
        $politicas = PoliticaNacional::all();

        return view('modulo1.objetivos.edit', compact('objetivo', 'planes', 'ejes', 'politicas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plan_institucional_id' => 'required|exists:plan_institucionales,id',
            'nombre' => 'required|max:200',
            'descripcion' => 'required',
            'eje_estrategico_nombre' => 'nullable|string|max:200',
            'politica_nacional_nombre' => 'nullable|string|max:200',
            'periodo_inicio' => 'required|date',
            'periodo_fin' => 'required|date|after_or_equal:periodo_inicio',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $objetivo = ObjetivoEstrategico::findOrFail($id);
        $objetivo->update($request->all());

        return redirect()->route('objetivos.index')->with('success', 'Objetivo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $objetivo = ObjetivoEstrategico::findOrFail($id);
        // Validación si tiene metas asociadas (implementar si aplica)
        $objetivo->delete();

        return redirect()->route('objetivos.index')->with('success', 'Objetivo eliminado correctamente.');
    }
}
