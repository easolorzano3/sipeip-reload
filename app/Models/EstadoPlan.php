<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPlan extends Model
{
    protected $fillable = ['nombre'];

    public function planes()
    {
        return $this->hasMany(PlanInstitucional::class, 'estado_id');
    }
}
