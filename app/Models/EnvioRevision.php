<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioRevision extends Model
{
    use HasFactory;

    protected $table = 'envios_revision';

    protected $fillable = [
        'plan_id',
        'estado_envio',
        'observaciones',
        'fecha_envio',
        'fecha_respuesta',
        'respuesta',
    ];

    // Relación con plan institucional
    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }
}
