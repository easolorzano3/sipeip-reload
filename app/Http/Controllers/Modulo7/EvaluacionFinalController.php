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

class EvaluacionFinalController extends Controller
{
    /**
     * Muestra la vista con pestañas para evaluar un proyecto específico.
     */
    public function show($id)
    {
        // 1. Cargar el proyecto con su plan
        $proyecto = ProyectoInversion::with(['plan'])->findOrFail($id);

        // 2. Cargar metas relacionadas al plan
        $metas = Meta::whereHas('objetivoEstrategico', function ($q) use ($proyecto) {
            $q->where('plan_institucional_id', $proyecto->plan_id);
        })->with('indicadores')->get();

        // 3. Cargar avances físicos del proyecto
        $avancesFisicos = AvanceFisico::where('proyecto_id', $proyecto->id)->get();

        // 4. Cargar avances financieros del proyecto
        $avancesFinancieros = AvanceFinanciero::where('proyecto_id', $proyecto->id)->get();

        // 5. Actividades POA relacionadas
        $actividades = ActividadPoa::where('plan_id', $proyecto->plan_id)->get();

        $conclusion = EvaluacionConclusion::where('proyecto_id', $id)->first();

        $lecciones = LeccionAprendida::where('proyecto_id', $id)->get();

        return view('modulo7.evaluacion.show', compact(
            'proyecto',
            'metas',
            'avancesFisicos',
            'avancesFinancieros',
            'actividades',
            'conclusion',
        ));
    }

    public function storeConclusiones(Request $request, $id)
    {
        $request->validate([
            'observaciones' => 'nullable|string',
            'advertencias' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        EvaluacionConclusion::updateOrCreate(
            ['proyecto_id' => $id],
            [
                'observaciones' => $request->observaciones,
                'advertencias' => $request->advertencias,
                'recomendaciones' => $request->recomendaciones,
                'user_id' => auth()->id(),
            ]
        );

        return back()->with('success', 'Conclusiones registradas correctamente.');
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

}
