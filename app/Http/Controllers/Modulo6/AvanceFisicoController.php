<?php

namespace App\Http\Controllers\Modulo6;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AvanceFisico;
use App\Models\ProyectoInversion;
use App\Models\Meta;
use Illuminate\Support\Facades\Auth;

class AvanceFisicoController extends Controller
{
    public function index()
    {
        $avances = AvanceFisico::with('proyecto', 'meta', 'usuario')->latest()->get();
        return view('modulo6.avance_fisico.index', compact('avances'));
    }

    public function create()
    {
        $proyectos = ProyectoInversion::all();
        $metas = Meta::all();
        return view('modulo6.avance_fisico.create', compact('proyectos', 'metas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'fase' => 'required|string|max:255',
            'meta_id' => 'nullable|exists:metas,id',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'fecha_corte' => 'required|date',
        ]);

        AvanceFisico::create([
            'proyecto_id' => $request->proyecto_id,
            'fase' => $request->fase,
            'meta_id' => $request->meta_id,
            'porcentaje' => $request->porcentaje,
            'fecha_corte' => $request->fecha_corte,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('avance-fisico.index')->with('success', 'Avance registrado correctamente');
    }

    public function edit($id)
    {
        $avance = AvanceFisico::findOrFail($id);
        $proyectos = ProyectoInversion::all();
        $metas = Meta::all();
        return view('modulo6.avance_fisico.edit', compact('avance', 'proyectos', 'metas'));
    }

    public function update(Request $request, $id)
    {
        $avance = AvanceFisico::findOrFail($id);

        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'fase' => 'required|string|max:255',
            'meta_id' => 'nullable|exists:metas,id',
            'porcentaje' => 'required|numeric|min:0|max:100',
            'fecha_corte' => 'required|date',
        ]);

        $avance->update([
            'proyecto_id' => $request->proyecto_id,
            'fase' => $request->fase,
            'meta_id' => $request->meta_id,
            'porcentaje' => $request->porcentaje,
            'fecha_corte' => $request->fecha_corte,
        ]);

        return redirect()->route('avance-fisico.index')->with('success', 'Avance actualizado correctamente');
    }

    public function destroy($id)
    {
        $avance = AvanceFisico::findOrFail($id);
        $avance->delete();
        return redirect()->route('avance-fisico.index')->with('success', 'Avance eliminado correctamente');
    }
}
