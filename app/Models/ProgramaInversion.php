<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramaInversion extends Model
{
    use HasFactory;

    protected $table = 'programas_inversion';

    protected $fillable = [
        'plan_id',
        'nombre',
        'descripcion',
        'sector',
        'estado',
        'created_by',
    ];

    // Relación: un programa tiene muchos proyectos
    public function proyectos()
    {
        return $this->hasMany(ProyectoInversion::class, 'programa_id');
    }

    // Relación: un programa pertenece a un plan institucional
    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }

    // Relación con el usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
