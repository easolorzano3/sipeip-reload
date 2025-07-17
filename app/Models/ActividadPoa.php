<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadPoa extends Model
{
    use HasFactory;

    protected $table = 'actividades_poa';

    protected $fillable = [
        'plan_id',
        'objetivo_estrategico_id',
        'meta_id',
        'nombre',
        'descripcion',
        'responsable_id',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto_estimado',
        'fuente_financiamiento',
        'indicador_resultado',
    ];

    // Relaciones

    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }

    public function objetivoEstrategico()
    {
        return $this->belongsTo(ObjetivoEstrategico::class, 'objetivo_estrategico_id');
    }

    public function meta()
    {
        return $this->belongsTo(Meta::class, 'meta_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
