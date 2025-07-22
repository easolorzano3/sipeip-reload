<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\ProyectoInversion;
use App\Models\AvanceFisico;
use App\Models\AvanceFinanciero;
use App\Models\DocumentoEvidencia;
use App\Models\PlanificacionEjecutiva;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


use Illuminate\Http\Request;

class Modulo6Controller extends Controller
{
    public function dashboard()
    {
        $proyectos = ProyectoInversion::all();
        $planificaciones = PlanificacionEjecutiva::with('proyecto', 'usuario')->latest()->get();
        $documentos = DocumentoEvidencia::with('usuario', 'proyecto')->latest()->get();
        $proyectos_viables = ProyectoInversion::where('estado', 'Aprobado')->get();

        return view('modulo6.dashboard', compact('proyectos', 'documentos', 'planificaciones', 'proyectos_viables'));
    }

    public function show($id)
    {
        $proyecto = \App\Models\ProyectoInversion::with([
            'programa',
            'plan',
            'actividad',
            'avancesFinancieros.usuario',
            'avancesFisicos.usuario',
            'avancesFisicos.meta'
        ])->findOrFail($id);

        return view('modulo6.proyectos.show', compact('proyecto'));
    }
    public function index()
    {
        $proyectos = ProyectoInversion::all();
        return view('modulo6.dashboard', compact('proyectos'));
    }

    public function showPorNombre($nombre)
    {
        $proyecto = ProyectoInversion::with([
            'avancesFinancieros.usuario',
            'avancesFisicos.usuario',
            'avancesFisicos.meta'
        ])->where('nombre', $nombre)->firstOrFail();

        return view('modulo6.proyectos.show', compact('proyecto'));
    }

    public function reporteAvances(Request $request)
    {
        $proyectos = ProyectoInversion::all();
        $avancesFisicos = collect();
        $avancesFinancieros = collect();

        if ($request->filled(['proyecto_id', 'fecha_inicio', 'fecha_fin'])) {
            $proyectoId = $request->input('proyecto_id');
            $fechaInicio = Carbon::parse($request->input('fecha_inicio'))->startOfDay();
            $fechaFin = Carbon::parse($request->input('fecha_fin'))->endOfDay();

            $avancesFisicos = AvanceFisico::where('proyecto_id', $proyectoId)
                ->whereBetween('fecha_corte', [$fechaInicio, $fechaFin])
                ->with('usuario', 'meta')
                ->get();

            $avancesFinancieros = AvanceFinanciero::where('proyecto_id', $proyectoId)
                ->whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->with('usuario')
                ->get();
        }

        return view('modulo6.reporte-avances', compact('proyectos', 'avancesFisicos', 'avancesFinancieros'));
    }

    public function reporte($id)
    {
        $proyecto = ProyectoInversion::with([
            'plan',
            'documentosEvidencias.usuario',
            'planificacionesEjecutivas.usuario',  // Agrega esto
        ])->findOrFail($id);

        return view('modulo6.reportes.show', compact('proyecto'));
    }

    public function generarReportePdf($id)
    {
        $proyecto = ProyectoInversion::with([
            'plan',
            'documentosEvidencias.usuario',
            'planificacionesEjecutivas.usuario'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('modulo6.reportes.pdf', compact('proyecto'));
        return $pdf->download('reporte_ejecucion_proyecto_' . $proyecto->id . '.pdf');
    }

    
}
