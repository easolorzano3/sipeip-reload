<?php

namespace App\Http\Controllers\Modulo4;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DictamenTecnico;
use App\Models\ProyectoInversion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DictamenTecnicoController extends Controller
{
    // Listar todos los dictámenes
    public function index()
    {
        $dictamenes = DictamenTecnico::with('proyecto.plan', 'usuario')->latest()->get();
        return view('modulo4.dictamenes.index', compact('dictamenes'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $proyectos = ProyectoInversion::with('plan')
            ->doesntHave('dictamenTecnico') // solo los que aún no tienen dictamen
            ->get();

        return view('modulo4.dictamenes.create', compact('proyectos'));
    }

    // Almacenar dictamen
    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos_inversion,id',
            'fecha_dictamen' => 'required|date',
            'estado_dictamen' => 'required|in:aprobado,observado,no_viable',
            'prioridad' => 'required|in:alta,media,baja,ninguna',
            'justificacion_tecnica' => 'required|string',
            'evaluacion_financiera' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        // Generar código automático
        $codigo = 'SNP-DICT-' . Carbon::now()->format('Y') . '-' . strtoupper(Str::random(5));

        DictamenTecnico::create([
            'proyecto_id' => $request->proyecto_id,
            'usuario_id' => Auth::id(),
            'fecha_dictamen' => $request->fecha_dictamen,
            'estado_dictamen' => $request->estado_dictamen,
            'prioridad' => $request->prioridad,
            'justificacion_tecnica' => $request->justificacion_tecnica,
            'evaluacion_financiera' => $request->evaluacion_financiera,
            'recomendaciones' => $request->recomendaciones,
            'codigo_dictamen' => $codigo,
        ]);

        return redirect()->route('dictamenes.index')->with('success', 'Dictamen técnico registrado correctamente.');
    }

    // Ver dictamen individual
    public function show($id)
    {
        $dictamen = DictamenTecnico::with('proyecto', 'usuario')->findOrFail($id);
        return view('modulo4.dictamenes.show', compact('dictamen'));
    }

    // Editar dictamen (opcional)
    public function edit($id)
    {
        $dictamen = DictamenTecnico::findOrFail($id);
        $proyectos = ProyectoInversion::all();
        return view('modulo4.dictamenes.edit', compact('dictamen', 'proyectos'));
    }

    // Actualizar dictamen
    public function update(Request $request, $id)
    {
        $dictamen = DictamenTecnico::findOrFail($id);

        $request->validate([
            'fecha_dictamen' => 'required|date',
            'estado_dictamen' => 'required|in:aprobado,observado,no_viable',
            'prioridad' => 'required|in:alta,media,baja,ninguna',
            'justificacion_tecnica' => 'required|string',
            'evaluacion_financiera' => 'nullable|string',
            'recomendaciones' => 'nullable|string',
        ]);

        $dictamen->update([
            'fecha_dictamen' => $request->fecha_dictamen,
            'estado_dictamen' => $request->estado_dictamen,
            'prioridad' => $request->prioridad,
            'justificacion_tecnica' => $request->justificacion_tecnica,
            'evaluacion_financiera' => $request->evaluacion_financiera,
            'recomendaciones' => $request->recomendaciones,
        ]);

        return redirect()->route('dictamenes.index')->with('success', 'Dictamen actualizado correctamente.');
    }

    // Eliminar dictamen (opcional)
    public function destroy($id)
    {
        $dictamen = DictamenTecnico::findOrFail($id);
        $dictamen->delete();

        return redirect()->route('dictamenes.index')->with('success', 'Dictamen eliminado correctamente.');
    }
}
