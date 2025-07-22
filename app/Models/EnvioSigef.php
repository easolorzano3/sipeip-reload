<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioSigef extends Model
{
    use HasFactory;

    protected $table = 'envios_sigef';

    protected $fillable = [
        'proyecto_id',
        'archivo_certificacion',
        'respuesta_sistema', // 'aprobado' o 'rechazado'
        'observaciones'
    ];

    public function proyecto()
    {
        return $this->belongsTo(\App\Models\ProyectoInversion::class, 'proyecto_id');
    }
}
