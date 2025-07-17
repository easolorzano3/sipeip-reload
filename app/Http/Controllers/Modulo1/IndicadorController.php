<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Indicador;
use App\Models\Meta;

class IndicadorController extends Controller
{
    public function index($meta_id)
    {
        $meta = Meta::with('indicadores')->findOrFail($meta_id);
        return view('modulo1.indicadores.index', compact('meta'));
    }

    public function create($meta_id)
    {
        $meta = Meta::findOrFail($meta_id);
        return view('modulo1.indicadores.create', compact('meta'));
    }

    public function store(Request $request, $meta_id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'nullable|string|max:100',
            'frecuencia' => 'nullable|string|max:100',
            'valor_referencia' => 'nullable|integer',
            'valor_meta' => 'nullable|integer',
            'metodologia' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);

        Indicador::create([
            'meta_id' => $meta_id,
            'nombre' => $request->nombre,
            'unidad' => $request->unidad,
            'frecuencia' => $request->frecuencia,
            'valor_referencia' => $request->valor_referencia,
            'valor_meta' => $request->valor_meta,
            'metodologia' => $request->metodologia,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('indicadores.index', $meta_id)
            ->with('success', 'Indicador registrado correctamente.');
    }

    public function edit($meta_id, Indicador $indicador)
    {
        return view('modulo1.indicadores.edit', compact('meta_id', 'indicador'));
    }

    public function update(Request $request, $meta_id, Indicador $indicador)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad' => 'nullable|string|max:100',
            'frecuencia' => 'nullable|string|max:100',
            'valor_referencia' => 'nullable|integer',
            'valor_meta' => 'nullable|integer',
            'metodologia' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);

        $indicador->update($request->all());

        return redirect()->route('indicadores.index', $meta_id)
            ->with('success', 'Indicador actualizado correctamente.');
    }

    public function destroy($meta_id, Indicador $indicador)
    {
        $indicador->delete();

        return redirect()->route('indicadores.index', $meta_id)
            ->with('success', 'Indicador eliminado correctamente.');
    }
}
