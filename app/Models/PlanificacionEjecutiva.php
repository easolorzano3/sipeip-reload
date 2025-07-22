<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanificacionEjecutiva extends Model
{

    protected $table = 'planificaciones_ejecutivas';

    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'hito',
        'fecha',
        'responsable',
        'observacion',
        'user_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }

    public function dashboard()
    {
        $proyectos = ProyectoInversion::all();
        $planificaciones = PlanificacionEjecutiva::with('proyecto', 'usuario')->latest()->get();

        return view('modulo6.dashboard', compact('proyectos', 'planificaciones'));
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    

}

