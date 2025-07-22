<?php

namespace App\Http\Controllers\Modulo6;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentoEvidencia;
use App\Models\ProyectoInversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentoEvidenciaController extends Controller
{
    
    public function index()
    {
        $proyectos = ProyectoInversion::all(); // si necesitas esto también
        $documentos = DocumentoEvidencia::with('usuario', 'proyecto')->latest()->get();

        return view('modulo6.bloque2', compact('proyectos', 'documentos'));
    }
        
    // Mostrar formulario
    public function create()
    {
        $proyectos = ProyectoInversion::all();
        $documentos = DocumentoEvidencia::with('proyecto', 'usuario')->latest()->get();
        return view('modulo6.documentos.create', compact('proyectos'));
        return view('modulo6.bloque2', compact('proyectos', 'documentos'));
    }

    // Guardar evidencia
    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'tipo' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'archivo' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx,xlsx,xls|max:5120', // 5MB
        ]);

        // Guardar archivo en storage/app/public/evidencias
        $archivoPath = $request->file('archivo')->store('evidencias', 'public');
        
        $archivo = $request->file('archivo');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $ruta = $archivo->storeAs('documentos_evidencias', $nombreArchivo, 'public');

        DocumentoEvidencia::create([
            'proyecto_id' => $request->proyecto_id,
            'usuario_id' => auth()->id(),
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'archivo' => $archivoPath,
            'fecha_subida' => now(),
        ]);

        return redirect()->back()->with('success', '📎 Documento cargado correctamente.');
    }
}
