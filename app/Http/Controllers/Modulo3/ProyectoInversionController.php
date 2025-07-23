<?php

namespace App\Http\Controllers\Modulo3;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ProyectoInversion;
use App\Models\ProgramaInversion;
use App\Models\ActividadPoa;
use App\Models\PlanInstitucional;
use App\Models\Meta;

class ProyectoInversionController extends Controller
{
    // Mostrar listado de proyectos
    public function index()
    {
        $proyectos = ProyectoInversion::with(['programa', 'plan'])->get();
        return view('modulo3.proyectos.index', compact('proyectos'));
    }

    // Formulario para crear nuevo proyecto
    public function create(Request $request)
    {
        // Capturar ID del programa desde query string
        $programaId = $request->query('programa_id');
        $metas = Meta::with('objetivo')->get();
        // Validar que venga un programa válido
        $programa = ProgramaInversion::with('plan')->findOrFail($programaId);
        $plan = $programa->plan;

        // Generar código del proyecto
        $anio = now()->year;
        $codigoGenerado = 'PROY-' . $anio . '-PLAN' . str_pad($plan->id, 2, '0', STR_PAD_LEFT)
                        . '-PROG' . str_pad($programa->id, 2, '0', STR_PAD_LEFT)
                        . '-' . str_pad(ProyectoInversion::where('programa_id', $programa->id)->count() + 1, 3, '0', STR_PAD_LEFT);

        // Actividades POA
        $actividades = ActividadPoa::all();

        return view('modulo3.proyectos.create', compact('plan', 'programa', 'actividades', 'codigoGenerado', 'metas'));
    }

    // Almacenar proyecto nuevo
    public function store(Request $request)
    {
        
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'programa_id' => 'nullable|exists:programas_inversion,id',
            'actividad_poa_id' => 'nullable|exists:actividades_poa,id',
            'nombre' => 'required|string|max:255',
            'codigo' => 'nullable|string|max:100',
            'objetivo_general' => 'nullable|string',
            'monto_estimado' => 'nullable|numeric|min:0',
            'cobertura' => 'nullable|string|max:255',
            'cronograma_inicio' => 'nullable|date',
            'cronograma_fin' => 'nullable|date|after_or_equal:cronograma_inicio',
        ]);

        $proyecto = ProyectoInversion::create([
            'plan_id' => $request->plan_id,
            'programa_id' => $request->programa_id,
            'actividad_poa_id' => $request->actividad_poa_id,
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'objetivo_general' => $request->objetivo_general,
            'monto_estimado' => $request->monto_estimado,
            'cobertura' => $request->cobertura,
            'cronograma_inicio' => $request->cronograma_inicio,
            'cronograma_fin' => $request->cronograma_fin,
            'estado' => 'borrador',
            'created_by' => auth()->id(),
        ]);

// Ahora sí puedes usar la variable
$proyecto->metas()->sync($request->meta_ids);
        
        return redirect()->route('proyectos.indexPorPrograma', ['id' => $request->programa_id])->with('success', 'Proyecto creado exitosamente.');

    }
    public function indexPorPrograma($id)
    {
        $programa = ProgramaInversion::with('proyectos')->findOrFail($id);
        return view('modulo3.proyectos.index', compact('programa'));
    }

    public function edit($id)
    {
        $proyecto = ProyectoInversion::with('metas')->findOrFail($id);
        $proyecto = ProyectoInversion::findOrFail($id);
        $programa = ProgramaInversion::findOrFail($proyecto->programa_id);
        $plan = PlanInstitucional::findOrFail($proyecto->plan_id);
        $actividades = ActividadPoa::all();
        $metas = Meta::with('objetivo')->get();

        return view('modulo3.proyectos.edit', compact('proyecto', 'programa', 'plan', 'actividades', 'metas'));
    }

    public function update(Request $request, $id)
    {
        $proyecto = ProyectoInversion::findOrFail($id);

        $proyecto->metas()->sync($request->meta_ids);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'actividad_poa_id' => 'nullable|exists:actividades_poa,id',
            'objetivo_general' => 'nullable|string',
            'monto_estimado' => 'nullable|numeric',
            'cobertura' => 'nullable|string|max:255',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
        ]);

        $proyecto->nombre = $request->nombre;
        $proyecto->actividad_poa_id = $request->actividad_poa_id;
        $proyecto->objetivo_general = $request->objetivo_general;
        $proyecto->monto_estimado = $request->monto_estimado;
        $proyecto->cobertura = $request->cobertura;
        $proyecto->cronograma_inicio = $request->fecha_inicio;
        $proyecto->cronograma_fin = $request->fecha_fin;

        $proyecto->save();

        return redirect()->route('proyectos.indexPorPrograma', ['id' => $proyecto->programa_id])
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    public function destroy($id)
    {
        $proyecto = ProyectoInversion::findOrFail($id);
        $programaId = $proyecto->programa_id;

        // Elimina las relaciones con metas
        $proyecto->metas()->detach();

        // Ahora sí puedes eliminar el proyecto
        $proyecto->delete();

        return redirect()
            ->route('proyectos.indexPorPrograma', ['id' => $programaId])
            ->with('success', 'Proyecto eliminado correctamente.');
    }

    public function show($id)
    {
        $proyecto = ProyectoInversion::with(['avancesFinancieros.usuario', 'avancesFisicos.usuario', 'avancesFisicos.meta'])->findOrFail($id);
        return view('modulo3.proyectos.show', compact('proyecto'));
    }
    // TODO: agregar métodos show, edit, update, destroy en las siguientes etapas
}
