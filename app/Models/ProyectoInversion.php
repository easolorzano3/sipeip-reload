<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoInversion extends Model
{
    use HasFactory;

    protected $table = 'proyectos_inversion';

    protected $fillable = [
        'programa_id',
        'plan_id',
        'actividad_poa_id',
        'nombre',
        'codigo',
        'objetivo_general',
        'monto_estimado',
        'cobertura',
        'cronograma_inicio',
        'cronograma_fin',
        'estado',
        'created_by',
    ];

    // 🔁 Relación: pertenece a un programa (puede ser null)
    public function programa()
    {
        return $this->belongsTo(ProgramaInversion::class, 'programa_id');
    }

    // Relación: pertenece a un plan institucional
    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }

    // Relación: pertenece a una actividad POA (opcional)
    public function actividad()
    {
        return $this->belongsTo(ActividadPoa::class, 'actividad_poa_id');
    }

    // Relación con el usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function dictamenTecnico()
    {
        return $this->hasOne(DictamenTecnico::class, 'proyecto_id');
    }

}
