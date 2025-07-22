<?php

namespace App\Http\Controllers\Modulo5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProyectoInversion;
use App\Models\TechoMultianual;
use Carbon\Carbon; //importar Carbon arriba


class TechoMultianualController extends Controller
{
    //
    public function create($id)
    {
        $proyecto = ProyectoInversion::with('plan')->findOrFail($id);
        $anios = range(
            Carbon::parse($proyecto->plan->anio_inicio)->year,
            Carbon::parse($proyecto->plan->anio_fin)->year
        );

        return view('modulo5.techos.create', compact('proyecto', 'anios'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'montos' => 'required|array',
            'montos.*' => 'nullable|numeric|min:0',
        ]);

        foreach ($data['montos'] as $anio => $monto) {
            if ($monto !== null) {
                TechoMultianual::updateOrCreate(
                    ['proyecto_id' => $data['proyecto_id'], 'anio' => $anio],
                    ['monto' => $monto]
                );
            }
        }

        return redirect()->route('modulo5.proyectos.show', $data['proyecto_id'])->with('success', 'Techo multianual asignado correctamente.');
    }

}
