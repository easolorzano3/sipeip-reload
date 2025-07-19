<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UnidadOrganizacional;
use App\Models\EstadoPlan;

class PlanInstitucional extends Model
{
    protected $table = 'plan_institucionales';

    protected $fillable = [
        'entidad',
        'nivel_gobierno',
        'codigo_institucional',
        'estado_institucional',
        'nombre',
        'codigo_plan',
        'anio_inicio',
        'anio_fin',
        'unidad_id',
        'estado_id', // nuevo campo vinculado a la tabla estado_plans
    ];

    // Relación con unidades ejecutoras (many-to-many)
    public function unidadesEjecutoras()
    {
        return $this->belongsToMany(UnidadOrganizacional::class, 'plan_unidad', 'plan_institucional_id', 'unidad_organizacional_id')->withTimestamps();
    }

    // Relación con estado de plan
    public function estado()
    {
        return $this->belongsTo(EstadoPlan::class, 'estado_id');
    }
}
