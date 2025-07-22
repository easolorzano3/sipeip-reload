<?php

namespace App\Http\Controllers\Modulo5;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProyectoInversion;
use App\Models\FuenteFinanciamiento;
use App\Models\FinanciamientoProyecto;
use App\Models\TechoMultianual;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class FinanciamientoProyectoController extends Controller
{
    // Mostrar formulario de asignación
    public function create($proyecto_id)
    {
        $proyecto = ProyectoInversion::findOrFail($proyecto_id);
        $fuentes = FuenteFinanciamiento::all();

        return view('modulo5.financiamientos.create', compact('proyecto', 'fuentes'));
    }

    // Guardar asignaciones
    
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'montos' => 'required|array',
            'montos.*' => 'nullable|numeric|min:0',
            'anios' => 'required|array',
            'anios.*' => 'nullable|integer|min:2024|max:2030',
        ]);

        foreach ($request->montos as $fuente_id => $monto) {
            $anio = $request->anios[$fuente_id] ?? null;

            if ($monto > 0 && $anio) {
                FinanciamientoProyecto::create([
                    'proyecto_id' => $request->proyecto_id,
                    'fuente_id' => $fuente_id,
                    'anio' => $anio,
                    'monto' => $monto
                ]);
            }
        }

        return redirect()->route('modulo5.proyectos.show', $request->proyecto_id)
            ->with('success', 'Fuentes asignadas correctamente.');
    }

    public function show($proyecto_id)
    {
        $proyecto = ProyectoInversion::findOrFail($proyecto_id);
        $financiamientos = FinanciamientoProyecto::with('fuente')
                            ->where('proyecto_id', $proyecto_id)
                            ->get();

        $techos = TechoMultianual::where('proyecto_id', $proyecto_id)
              ->orderBy('anio')
              ->get();                   
        $total = $financiamientos->sum('monto');

        // Verificar si existe PDF de certificación
        $certificacionPath = "certificaciones/certificacion_proyecto_{$proyecto_id}.pdf";
        $certificacionGenerada = Storage::disk('public')->exists($certificacionPath);

        return view('modulo5.financiamientos.show', compact('proyecto', 'financiamientos', 'techos','total', 'certificacionGenerada'));
    }
    // Mostrar formulario de edición
    public function edit($id)
    {
        $financiamiento = FinanciamientoProyecto::with('fuente')->findOrFail($id);
        return view('modulo5.financiamientos.edit', compact('financiamiento'));
    }

    // Actualizar monto
    public function update(Request $request, $id)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
        ]);

        $financiamiento = FinanciamientoProyecto::findOrFail($id);
        $financiamiento->update(['monto' => $request->monto]);

        return redirect()->route('modulo5.proyectos.show', $financiamiento->proyecto_id)
            ->with('success', 'Monto actualizado correctamente.');
    }

    // Eliminar financiamiento
    public function destroy($id)
    {
        $financiamiento = FinanciamientoProyecto::findOrFail($id);
        $proyecto_id = $financiamiento->proyecto_id;
        $financiamiento->delete();

        return redirect()->route('modulo5.proyectos.show', $proyecto_id)
            ->with('success', 'Fuente eliminada correctamente.');
    }

    public function generarCertificacion($proyecto_id)
    {
        $proyecto = ProyectoInversion::with('plan')->findOrFail($proyecto_id);
        $financiamientos = FinanciamientoProyecto::with('fuente')
                            ->where('proyecto_id', $proyecto_id)
                            ->orderBy('anio')
                            ->get();
        $techos = \App\Models\TechoMultianual::where('proyecto_id', $proyecto_id)
                    ->orderBy('anio')->get();

        $totalAsignado = $financiamientos->sum('monto');

        $pdf = PDF::loadView('modulo5.financiamientos.certificacion-pdf', compact(
            'proyecto', 'financiamientos', 'techos', 'totalAsignado'
        ));

        $filename = 'certificacion_presupuestaria_' . $proyecto->codigo . '.pdf';
        $path = storage_path('app/public/certificaciones/' . $filename);

        // Guardar el archivo en storage/app/public/certificaciones
        $pdf->save($path);

        // También mostrarlo al usuario
        return $pdf->stream($filename);
    }


    public function enviarEsigef(Request $request, $proyecto_id)
    {
        $request->validate([
            'archivo_firmado' => 'required|mimes:pdf|max:2048'
        ]);

        $proyecto = ProyectoInversion::findOrFail($proyecto_id);

        $archivo = $request->file('archivo_firmado');
        $nombreArchivo = "certificacion_firmada_proyecto_{$proyecto_id}.pdf";
        $ruta = $archivo->storeAs('certificaciones_firmadas', $nombreArchivo, 'public');

        // Simulación de respuesta eSIGEF
        session()->flash('success', 'Certificación enviada a eSIGEF. ✅ Proyecto aprobado.');

        // Aquí podrías registrar en BD el estado: aprobado / rechazado (simulado)

        return redirect()->route('modulo5.proyectos.show', $proyecto_id);
    }

    }
