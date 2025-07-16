<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadOrganizacional extends Model
{
    // use HasFactory;
    protected $table = 'unidad_organizacionales';

    public function planesInstitucionales()
    {
        return $this->belongsToMany(PlanInstitucional::class, 'plan_unidad', 'unidad_organizacional_id', 'plan_institucional_id')->withTimestamps();
    }
}
