<?php

namespace App\Http\Controllers\Modulo1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentoRespaldo;
use App\Models\PlanInstitucional;
use Illuminate\Support\Facades\Storage;

class DocumentoRespaldoController extends Controller
{
    public function index()
    {
        $documentos = DocumentoRespaldo::with('plan')->get();
        return view('modulo1.documentos.index', compact('documentos'));
    }

    public function create()
    {
        $planes = PlanInstitucional::all();
        return view('modulo1.documentos.create', compact('planes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'nombre_documento' => 'required|string|max:255',
            'archivo' => 'required|file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg',
            'tipo' => 'nullable|string|max:255',
            'fecha_carga' => 'nullable|date',
        ]);

        $rutaArchivo = $request->file('archivo')->store('documentos_respaldo', 'public');

        DocumentoRespaldo::create([
            'plan_id' => $request->plan_id,
            'nombre_documento' => $request->nombre_documento,
            'archivo' => $rutaArchivo,
            'tipo' => $request->tipo,
            'fecha_carga' => $request->fecha_carga ?? now(),
        ]);

        return redirect()->route('documentos.index')->with('success', 'Documento cargado correctamente.');
    }

    public function edit($id)
    {
        $documento = DocumentoRespaldo::findOrFail($id);
        $planes = PlanInstitucional::all();
        return view('modulo1.documentos.edit', compact('documento', 'planes'));
    }

    public function update(Request $request, DocumentoRespaldo $documento)
    {
        $request->validate([
            'plan_id' => 'required|exists:plan_institucionales,id',
            'nombre_documento' => 'required|string|max:255',
            'archivo' => 'nullable|file|mimes:pdf,doc,docx,xlsx,png,jpg,jpeg',
            'tipo' => 'nullable|string|max:255',
            'fecha_carga' => 'nullable|date',
        ]);

        // Si se sube un nuevo archivo
        if ($request->hasFile('archivo')) {
            // Opcional: eliminar archivo anterior si quieres
            if ($documento->archivo && Storage::disk('public')->exists($documento->archivo)) {
                Storage::disk('public')->delete($documento->archivo);
            }

            $rutaArchivo = $request->file('archivo')->store('documentos_respaldo', 'public');
            $documento->archivo = $rutaArchivo;
        }

        $documento->plan_id = $request->plan_id;
        $documento->nombre_documento = $request->nombre_documento;
        $documento->tipo = $request->tipo;
        $documento->fecha_carga = $request->fecha_carga ?? now();
        $documento->save();

        return redirect()->route('documentos.index')->with('success', 'Documento actualizado correctamente.');
    }


    public function destroy($id)
    {
        $documento = DocumentoRespaldo::findOrFail($id);

        if ($documento->archivo && Storage::exists($documento->archivo)) {
            Storage::delete($documento->archivo);
        }

        $documento->delete();

        return redirect()->route('documentos.index')->with('success', 'Documento eliminado correctamente.');
    }
}
