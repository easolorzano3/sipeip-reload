<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DictamenTecnico extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'usuario_id',
        'fecha_dictamen',
        'estado_dictamen',
        'prioridad',
        'codigo_dictamen',
        'justificacion_tecnica',
        'evaluacion_financiera',
        'recomendaciones',
        'archivo_dictamen',
    ];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
