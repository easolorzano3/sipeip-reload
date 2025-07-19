<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoRespaldo extends Model
{
    use HasFactory;

    protected $table = 'documentos_respaldo';

    protected $fillable = [
        'plan_id',
        'nombre_documento',
        'archivo',
        'tipo',
        'fecha_carga',
    ];

    // Relación con el Plan Institucional
    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }
}
