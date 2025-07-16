<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadOrganizacional;

class PlanInstitucional extends Model
{
    protected $table = 'plan_institucionales';

    protected $fillable = [
        'entidad',
        'nivel',
        'codigo_institucional',
        'estado_institucion',
        'nombre',
        'codigo',
        'periodo_inicio',
        'periodo_fin',
        'unidad_id',
        'estado',
    ];

    //Relación con unidades ejecutoras (many-to-many)
    public function unidadesEjecutoras()
    {
        return $this->belongsToMany(UnidadOrganizacional::class, 'plan_unidad', 'plan_institucional_id', 'unidad_organizacional_id')->withTimestamps();
    
    }
}
