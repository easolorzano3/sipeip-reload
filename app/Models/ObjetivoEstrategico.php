<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjetivoEstrategico extends Model
{
    use HasFactory;
    protected $table = 'objetivos_estrategicos'; //
    protected $fillable = [
        'plan_institucional_id',
        'eje_estrategico_nombre',
        'politica_nacional_nombre',
        'nombre',
        'descripcion',
        'periodo_inicio',
        'periodo_fin',
        'estado',
    ];

    public function planInstitucional()
    {
        return $this->belongsTo(PlanInstitucional::class);
    }

    public function ejeEstrategico()
    {
        return $this->belongsTo(EjeEstrategico::class);
    }

    public function politicaNacional()
    {
        return $this->belongsTo(PoliticaNacional::class);
    }
}
