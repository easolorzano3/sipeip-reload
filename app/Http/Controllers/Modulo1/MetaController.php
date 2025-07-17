<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\ObjetivoEstrategico;

class MetaController extends Controller
{
    public function index()
    {
        $metas = Meta::with('objetivoEstrategico')->get();
        return view('modulo1.metas.index', compact('metas'));
    }

    public function create()
    {
        $objetivos = ObjetivoEstrategico::all();
        return view('modulo1.metas.create', compact('objetivos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'objetivo_estrategico_id' => 'required|exists:objetivos_estrategicos,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Meta::create($request->all());

        return redirect()->route('metas.index')->with('success', 'Meta registrada correctamente.');
    }

    public function edit(Meta $meta)
    {
        $objetivos = ObjetivoEstrategico::all();
        return view('modulo1.metas.edit', compact('meta', 'objetivos'));
    }

    public function update(Request $request, Meta $meta)
    {
        $request->validate([
            'objetivo_estrategico_id' => 'required|exists:objetivos_estrategicos,id',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $meta->update($request->all());

        return redirect()->route('metas.index')->with('success', 'Meta actualizada correctamente.');
    }

    public function destroy(Meta $meta)
    {
        $meta->delete();

        return redirect()->route('metas.index')->with('success', 'Meta eliminada correctamente.');
    }
}
