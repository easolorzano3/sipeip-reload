<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use App\Models\PlanInstitucional;
use App\Models\UnidadOrganizacional;
use Illuminate\Http\Request;

class PlanInstitucionalController extends Controller
{
    public function index()
    {
        $planes = PlanInstitucional::where('unidad_id', auth()->user()->unidad_organizacional_id)->get();
        return view('modulo1.planes.index', compact('planes'));
    }

    public function create()
    {
        $unidades = UnidadOrganizacional::all(); // 👈 Requerido para checkboxes
        return view('modulo1.planes.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        // Validación completa
        $request->validate([
            'entidad' => 'required|string|max:255',
            'nivel' => 'required|string|max:100',
            'codigo_institucional' => 'required|string|max:50',
            'estado_institucion' => 'required|string|in:Activo,Inactivo',
            'nombre' => 'required|string|max:255',
            'codigo' => 'nullable|string|max:50',
            'periodo_inicio' => 'required|integer|min:2024',
            'periodo_fin' => 'required|integer|gte:periodo_inicio',
            'unidades' => 'nullable|array',
            'unidades.*' => 'exists:unidad_organizacionales,id',
        ]);

        //  Crear el plan institucional
        $plan = PlanInstitucional::create([
            'entidad' => $request->entidad,
            'nivel' => $request->nivel,
            'codigo_institucional' => $request->codigo_institucional,
            'estado_institucion' => $request->estado_institucion,
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin' => $request->periodo_fin,
            'unidad_id' => auth()->user()->unidad_organizacional_id,
            'estado' => 'borrador',
        ]);

        //  Guardar relación con unidades ejecutoras (tabla pivote)
        if ($request->filled('unidades')) {
            $plan->unidadesEjecutoras()->sync($request->unidades);
        }

        return redirect()->route('planes.index')->with('success', 'Plan institucional registrado correctamente.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $plan = PlanInstitucional::findOrFail($id);
        $unidades = UnidadOrganizacional::all();
        $unidadesSeleccionadas = $plan->unidadesEjecutoras()->pluck('unidad_organizacional_id')->toArray();
        
        return view('modulo1.planes.edit', compact('plan', 'unidades', 'unidadesSeleccionadas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'entidad' => 'required|string|max:255',
            'nivel' => 'required|string|max:100',
            'codigo_institucional' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'codigo' => 'nullable|string|max:255',
            'periodo_inicio' => 'required|integer|min:2024',
            'periodo_fin' => 'required|integer|gte:periodo_inicio',
            'estado_institucion' => 'required|in:activo,inactivo',
            'unidades' => 'nullable|array',
            'unidades.*' => 'exists:unidad_organizacionales,id',
        ]);

        $plan = PlanInstitucional::findOrFail($id);
        $plan->update([
            'entidad' => $request->entidad,
            'nivel' => $request->nivel,
            'codigo_institucional' => $request->codigo_institucional,
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin' => $request->periodo_fin,
            'estado_institucion' => $request->estado_institucion,
        ]);
        //  Actualizar unidades ejecutoras
        $plan->unidadesEjecutoras()->sync($request->unidades ?? []);
        return redirect()->route('planes.index')->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        //
    }
}
