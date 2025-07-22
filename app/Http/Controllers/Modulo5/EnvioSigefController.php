<?php

namespace App\Http\Controllers\Modulo5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnvioSigef;
use App\Models\ProyectoInversion;
use Illuminate\Support\Facades\Storage;

class EnvioSigefController extends Controller
{
    public function index()
    {
        $envios = EnvioSigef::with('proyecto')->latest()->get();
        return view('modulo5.envios.index', compact('envios'));
    }

    public function create($proyecto_id)
    {
        $proyecto = ProyectoInversion::findOrFail($proyecto_id);
        return view('modulo5.envios.create', compact('proyecto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'archivo_certificacion' => 'required|mimes:pdf|max:2048',
            'respuesta_sistema' => 'required|in:aprobado,rechazado',
            'observaciones' => 'nullable|string|max:1000'
        ]);

        $archivo = $request->file('archivo_certificacion')->store('certificaciones', 'public');

        EnvioSigef::create([
            'proyecto_id' => $request->proyecto_id,
            'archivo_certificacion' => $archivo,
            'respuesta_sistema' => $request->respuesta_sistema,
            'observaciones' => $request->observaciones
        ]);

        return redirect()->route('envios-sigef.index')->with('success', 'Envío simulado realizado correctamente.');
    }
    public function formulario($proyecto_id)
    {
        $proyecto = ProyectoInversion::findOrFail($proyecto_id);
        return view('modulo5.envios.formulario', compact('proyecto'));
    }
}
