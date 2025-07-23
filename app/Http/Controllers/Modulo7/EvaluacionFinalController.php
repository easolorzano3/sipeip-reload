<?php

namespace App\Http\Controllers\Modulo7;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProyectoInversion;
use App\Models\AvanceFisico;
use App\Models\AvanceFinanciero;
use App\Models\Meta;
use App\Models\Indicador;
use App\Models\ActividadPoa;
use App\Models\EvaluacionConclusion;
use App\Models\LeccionAprendida;
use App\Models\InformeFirmado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CierreProyecto;
use App\Models\PlanInstitucional;



class EvaluacionFinalController extends Controller
{
    /**
     * Muestra la vista con pestañas para evaluar un proyecto específico.
     */
    public function show($id)
    {
        // Proyecto actual
        $proyecto = ProyectoInversion::with(['plan'])->findOrFail($id);

        // Metas asociadas al plan
        $metas = Meta::whereHas('objetivoEstrategico', function ($q) use ($proyecto) {
            $q->where('plan_institucional_id', $proyecto->plan_id);
        })->with('indicadores')->get();

        $avancesFisicos = AvanceFisico::where('proyecto_id', $proyecto->id)->get();
        $avancesFinancieros = AvanceFinanciero::where('proyecto_id', $proyecto->id)->get();
        $actividades = ActividadPoa::where('plan_id', $proyecto->plan_id)->get();

        $conclusion = EvaluacionConclusion::where('proyecto_id', $id)->first();
        $lecciones = LeccionAprendida::where('proyecto_id', $id)->get();

        // === NUEVO: Indicadores globales para el dashboard visual ===
        $totalProyectos = ProyectoInversion::count();
        $proyectosFinalizados = ProyectoInversion::where('estado', 'finalizado')->count();
        $proyectosEnEjecucion = ProyectoInversion::where('estado', 'ejecucion')->count();

        $avanceFinanciero = ProyectoInversion::with('avanceFinanciero')->get()->map(function ($p) {
            return $p->avanceFinanciero()->avg('valor_ejecutado') ?? 0;
        })->avg() ?? 0;

        $totalUsuarios = \App\Models\User::count();

        $planesTotales = PlanInstitucional::count();
        $planesBorrador = PlanInstitucional::where('estado_i', 'borrador')->count();
        $planesEnviados = PlanInstitucional::where('estado_i', 'en_revision')->count();
        $planesAprobados = PlanInstitucional::where('estado_i', 'aprobado')->count();
        $planesPublicados = PlanInstitucional::where('estado_id', 6)->count();
        $planesFinalizados = PlanInstitucional::where('estado_id', 7)->count();

        return view('modulo7.evaluacion.show', compact(
            'proyecto',
            'metas',
            'avancesFisicos',
            'avancesFinancieros',
            'actividades',
            'conclusion',
            'lecciones',
            'totalProyectos',
            'proyectosFinalizados',
            'proyectosEnEjecucion',
            'avanceFinanciero',
            'totalUsuarios',
            'planesTotales',
            'planesBorrador',
            'planesEnviados',
            'planesAprobados',
            'planesPublicados',
            'planesFinalizados'
        ));
    }

    public function storeLeccion(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|in:error,acierto,mejora',
            'descripcion' => 'required|string|min:5',
        ]);

        LeccionAprendida::create([
            'proyecto_id' => $id,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Lección aprendida registrada.');
    }

    public function generarInforme($id)
    {
        $proyecto = ProyectoInversion::with('plan')->findOrFail($id);

        $pdf = Pdf::loadView('modulo7.evaluacion.pdf.informe', compact('proyecto'));

        $filename = 'informe_proyecto_'.$id.'_'.now()->format('Ymd_His').'.pdf';
        $path = 'informes/'.$filename;
        Storage::disk('public')->put($path, $pdf->output());

        // Registra o actualiza el informe
        $informe = InformeFirmado::updateOrCreate(
            ['proyecto_id' => $id],
            ['archivo_pdf' => $path]
        );

        return back()->with('success', 'Informe generado correctamente.');
    }

    public function firmarInforme($id)
    {
        $informe = InformeFirmado::where('proyecto_id', $id)->firstOrFail();

        $informe->update([
            'firmado_en' => now(),
            'firmado_por' => auth()->id()
        ]);

        return back()->with('success', 'Informe firmado correctamente.');
    }

    public function cerrarProyecto(Request $request, $id)
    {
        $proyecto = ProyectoInversion::findOrFail($id);

        // Verificar que ya tenga informe firmado
        if (!$proyecto->informeFirmado || !$proyecto->informeFirmado->firmado_en) {
            return back()->with('error', 'No se puede cerrar el proyecto sin informe firmado.');
        }

        // Registrar cierre
        CierreProyecto::create([
            'proyecto_id' => $id,
            'fecha_cierre' => now(),
            'cerrado_por' => auth()->id(),
            'descripcion' => $request->descripcion,
        ]);

        // Cambiar estado del proyecto
        $proyecto->estado = 'cerrado';
        $proyecto->save();

        return back()->with('success', 'Proyecto cerrado exitosamente.');
    }

    public function reportes(Request $request)
    {
        $query = ProyectoInversion::with('plan');

        if ($request->filled('nombre')) {
            $query->where('nombre', 'like', '%'.$request->nombre.'%');
        }

        if ($request->filled('codigo')) {
            $query->where('codigo', 'like', '%'.$request->codigo.'%');
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        $proyectos = $query->get();

        return view('modulo7.evaluacion.reportes.index', compact('proyectos'));
    }

    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $planes = PlanInstitucional::with('estado')
            ->where('estado_id', 6) // Publicado
            ->get();

        return view('modulo7.dashboard', compact('planes'));
    }

    public function generarInformePdf(Request $request)
    {
        $estadoId = $request->estado_id;
        $planId = $request->plan_id;

        $planes = PlanInstitucional::with([
            'metas.indicadores',
            'programas.proyectos'
        ])
        ->when($estadoId, fn($q) => $q->where('estado_id', $estadoId))
        ->when($planId, fn($q) => $q->where('id', $planId))
        ->get();

        // Generar PDF con vista blade
        $pdf = Pdf::loadView('modulo7.reportes.reporte_pdf', compact('planes'));

        return $pdf->stream('informe_consolidado.pdf');
    }

}
