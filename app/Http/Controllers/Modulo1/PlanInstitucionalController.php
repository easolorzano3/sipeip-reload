<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use App\Models\EstadoPlan;
use App\Models\PlanInstitucional;
use App\Models\UnidadOrganizacional;
use App\Models\VersionHistorial;
use Illuminate\Http\Request;

class PlanInstitucionalController extends Controller
{
    public function index()
    {
        if (auth()->user()->can('ver modulo planificación institucional')) {
            // Si tiene permiso, ve todos los planes
            $planes = PlanInstitucional::with('estado')->get();
        } else {
            // Caso contrario, solo los de su unidad
            $planes = PlanInstitucional::with('estado')
                ->where('unidad_id', auth()->user()->unidad_organizacional_id)
                ->get();
        }

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
            'nivel_gobierno' => 'required|string|max:100',
            'codigo_institucional' => 'required|string|max:50',
            'estado_institucional' => 'required|string|in:Activo,Inactivo',
            'nombre' => 'required|string|max:255',
            'codigo_plan' => 'nullable|string|max:50',
            'anio_inicio' => 'required|date',
            'anio_fin' => 'required|date|after_or_equal:anio_inicio',
            'unidades' => 'nullable|array',
            'unidades.*' => 'exists:unidad_organizacionales,id',
        ]);
        // Buscar el estado 'borrador' desde la tabla estado_plans
        $estadoBorrador = EstadoPlan::where('nombre', 'borrador')->firstOrFail();
        //  Crear el plan institucional
        $plan = PlanInstitucional::create([
            'entidad' => $request->entidad,
            'nivel_gobierno' => $request->nivel_gobierno,
            'codigo_institucional' => $request->codigo_institucional,
            'estado_institucional' => $request->estado_institucional,
            'nombre' => $request->nombre,
            'codigo_plan' => $request->codigo_plan,
            'anio_inicio' => $request->anio_inicio,
            'anio_fin' => $request->anio_fin,
            'unidad_id' => auth()->user()->unidad_organizacional_id,
            'estado_id' => $estadoBorrador->id, // aquí usamos el id de la tabla estado_plans
        ]);
          // Aquí va el paso 2: guardar en versiones_historial
        VersionHistorial::create([
            'plan_id' => $plan->id,
            'accion' => 'Creación de Plan Institucional',
            'descripcion' => 'Se registró la creación del plan "' . $plan->nombre . '" con código ' . $plan->codigo_plan,
            'usuario_id' => auth()->user()->id,
            'fecha_accion' => now(),
        ]);   
        //  Guardar relación con unidades ejecutoras (tabla pivote)
        if ($request->filled('unidades')) {
            $plan->unidadesEjecutoras()->sync($request->unidades);
        }

        return redirect()->route('planes.index')->with('success', 'Plan institucional registrado correctamente.');
    }

    public function show(string $id)
    {
        $plan = PlanInstitucional::with('estado')->findOrFail($id);
        return view('modulo1.planes.show', compact('plan'));
    }

    public function edit($id)
    {
        $plan = PlanInstitucional::findOrFail($id);
        $unidades = UnidadOrganizacional::all();
        $unidadesSeleccionadas = $plan->unidadesEjecutoras->pluck('id')->toArray();
        //dd($unidadesSeleccionadas);
        return view('modulo1.planes.edit', compact('plan', 'unidades', 'unidadesSeleccionadas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'entidad' => 'required|string|max:255',
            'nivel_gobierno' => 'required|string|max:100',
            'codigo_institucional' => 'required|string|max:50',
            'nombre' => 'required|string|max:255',
            'codigo_plan' => 'nullable|string|max:255',
            'anio_inicio' => 'required|date',
            'anio_fin' => 'required|date|after_or_equal:anio_inicio',
            'estado_institucional' => 'required|in:Activo,Inactivo',
            'unidades' => 'nullable|array',
            'unidades.*' => 'exists:unidad_organizacionales,id',
        ]);

        $plan = PlanInstitucional::findOrFail($id);

        $campos = [
            'entidad',
            'nivel_gobierno',
            'codigo_institucional',
            'nombre',
            'codigo_plan',
            'anio_inicio',
            'anio_fin',
            'estado_institucional',
        ];

        foreach ($request->only($campos) as $campo => $valorNuevo) {
            $valorOriginal = $plan->getOriginal($campo);

            if ($valorOriginal != $valorNuevo) {
                $campoLegible = match ($campo) {
                    'entidad' => 'entidad',
                    'nivel_gobierno' => 'nivel de gobierno',
                    'codigo_institucional' => 'código institucional',
                    'estado_institucional' => 'estado de la institución',
                    'nombre' => 'nombre del plan',
                    'codigo_plan' => 'código del plan',
                    'anio_inicio' => 'año de inicio',
                    'anio_fin' => 'año de finalización',
                    default => $campo,
                };

                $descripcion = "Se modificó el {$campoLegible} de '{$valorOriginal}' a '{$valorNuevo}'";

                VersionHistorial::create([
                    'plan_id' => $plan->id,
                    'accion' => 'Modificación de ' . ucfirst($campoLegible),
                    'descripcion' => $descripcion,
                    'usuario_id' => auth()->user()->id,
                    'fecha_accion' => now(),
                ]);
            }
        }

        // Actualizar los campos del plan
        $plan->update($request->only($campos));

        // Actualizar unidades ejecutoras
        $plan->unidadesEjecutoras()->sync($request->unidades ?? []);

        return redirect()->route('planes.index')->with('success', 'Plan actualizado correctamente.');
    }



    public function destroy(string $id)
    {
        //
    }
}
