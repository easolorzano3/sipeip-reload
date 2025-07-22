<?php

namespace App\Http\Controllers\Modulo6;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProyectoInversion;
use App\Models\AvanceFisico;
use App\Models\AvanceFinanciero;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteAvanceController extends Controller
{
    public function generarPDF(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'desde' => 'required|date',
            'hasta' => 'required|date|after_or_equal:desde',
        ]);

        $proyecto = ProyectoInversion::findOrFail($request->proyecto_id);

        $avancesFisicos = AvanceFisico::where('proyecto_id', $proyecto->id)
            ->whereBetween('fecha_corte', [$request->desde, $request->hasta])
            ->get();

        $avancesFinancieros = AvanceFinanciero::where('proyecto_id', $proyecto->id)
            ->whereBetween('fecha_corte', [$request->desde, $request->hasta])
            ->get();

        

        return Pdf::loadView('modulo6.reportes.pdf-avances', [
            'proyecto' => $proyecto,
            'avancesFisicos' => $avancesFisicos,
            'avancesFinancieros' => $avancesFinancieros,
            'desde' => $request->desde,
            'hasta' => $request->hasta,
        ])->stream('reporte-avances.pdf'); // o ->download('reporte-avances.pdf')
    }
}
