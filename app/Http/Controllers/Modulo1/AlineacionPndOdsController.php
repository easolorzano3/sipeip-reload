<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use App\Models\AlineacionPndOds;
use App\Models\ObjetivoEstrategico;
use App\Models\PndObjetivo;
use App\Models\OdsObjetivo;
use Illuminate\Http\Request;

class AlineacionPndOdsController extends Controller
{
    public function index()
    {
        $alineaciones = AlineacionPndOds::with(['objetivoEstrategico', 'pnd', 'ods'])->get();
        return view('modulo1.alineaciones.index', compact('alineaciones'));
    }

    public function create()
    {
        $objetivos = ObjetivoEstrategico::all();
        $pnd = PndObjetivo::all();
        $ods = OdsObjetivo::all();

        return view('modulo1.alineaciones.create', compact('objetivos', 'pnd', 'ods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'objetivo_estrategico_id' => 'required|exists:objetivos_estrategicos,id',
            'pnd_id' => 'nullable|exists:pnd_objetivos,id',
            'ods_id' => 'nullable|exists:ods_objetivos,id',
            'indicador' => 'nullable|string|max:255',
            'justificacion' => 'nullable|string',
        ]);

        AlineacionPndOds::create($request->all());

        return redirect()->route('alineaciones-pnd-ods.index')->with('success', 'Alineación registrada correctamente.');
    }

    public function edit(AlineacionPndOds $alineacion)
    {
        $objetivos = ObjetivoEstrategico::all();
        $pnd = PndObjetivo::all();
        $ods = OdsObjetivo::all();

        return view('modulo1.alineaciones.edit', compact('alineacion', 'objetivos', 'pnd', 'ods'));
    }

    public function update(Request $request, AlineacionPndOds $alineacion)
    {
        $request->validate([
            'objetivo_estrategico_id' => 'required|exists:objetivos_estrategicos,id',
            'pnd_id' => 'nullable|exists:pnd_objetivos,id',
            'ods_id' => 'nullable|exists:ods_objetivos,id',
            'indicador' => 'nullable|string|max:255',
            'justificacion' => 'nullable|string',
        ]);

        $alineacion->update($request->all());

        return redirect()->route('alineaciones-pnd-ods.index')->with('success', 'Alineación actualizada correctamente.');
    }

    public function destroy(AlineacionPndOds $alineacion)
    {
        $alineacion->delete();

        return redirect()->route('alineaciones-pnd-ods.index')->with('success', 'Alineación eliminada correctamente.');
    }
}
