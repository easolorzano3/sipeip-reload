<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsignacionPresupuestaria extends Model
{
    protected $table = 'asignaciones_presupuestarias';

    protected $fillable = [
        'proyecto_id',
        'estado'
    ];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }
}
