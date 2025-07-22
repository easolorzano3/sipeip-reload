<?php

namespace App\Http\Controllers\Modulo6;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AvanceFinanciero;
use App\Models\ProyectoInversion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AvanceFinancieroController extends Controller
{
    public function index()
    {
        $avances = AvanceFinanciero::with('proyecto', 'usuario')->latest()->get();
        return view('modulo6.avance_financiero.index', compact('avances'));
    }

    public function create()
    {
        $proyectos = ProyectoInversion::all();
        return view('modulo6.avance_financiero.create', compact('proyectos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id'     => 'required|exists:proyectos_inversion,id',
            'componente'      => 'required|string|max:255',
            'valor_ejecutado' => 'required|numeric|min:0',
            'fecha_corte'     => 'required|date',
        ]);

        AvanceFinanciero::create([
            'proyecto_id'     => $request->proyecto_id,
            'componente'      => $request->componente,
            'valor_ejecutado' => $request->valor_ejecutado,
            'fecha_corte'     => $request->fecha_corte,
            'usuario_id'      => Auth::id(),
        ]);

        return redirect()->route('avance-financiero.index')->with('success', 'Avance financiero registrado exitosamente.');
    }

    public function edit($id)
    {
        $avance = AvanceFinanciero::findOrFail($id);
        $proyectos = ProyectoInversion::all();

        return view('modulo6.avance_financiero.edit', compact('avance', 'proyectos'));
    }

    public function update(Request $request, $id)
    {
        $avance = AvanceFinanciero::findOrFail($id);

        $request->validate([
            'proyecto_id'     => 'required|exists:proyectos_inversion,id',
            'componente'      => 'required|string|max:255',
            'valor_ejecutado' => 'required|numeric|min:0',
            'fecha_corte'     => 'required|date',
        ]);

        $avance->update([
            'proyecto_id'     => $request->proyecto_id,
            'componente'      => $request->componente,
            'valor_ejecutado' => $request->valor_ejecutado,
            'fecha_corte'     => $request->fecha_corte,
        ]);

        return redirect()->route('avance-financiero.index')->with('success', 'Avance financiero actualizado correctamente.');
    }

    public function destroy($id)
    {
        $avance = AvanceFinanciero::findOrFail($id);
        $avance->delete();

        return redirect()->route('avance-financiero.index')->with('success', 'Avance financiero eliminado.');
    }

    public function generarCertificacion($proyecto_id)
    {
        $proyecto = ProyectoInversion::with('plan')->findOrFail($proyecto_id);
        $avances = AvanceFinanciero::where('proyecto_id', $proyecto_id)
                    ->with('usuario')
                    ->orderBy('fecha_corte', 'asc')
                    ->get();

        $total_ejecutado = $avances->sum('valor_ejecutado');

        $pdf = Pdf::loadView('modulo6.avance_financiero.certificacion_pdf', compact('proyecto', 'avances', 'total_ejecutado'))
                    ->setPaper('A4', 'portrait');

        return $pdf->stream("certificacion-avance-financiero-proyecto-{$proyecto->id}.pdf");
    }



}
