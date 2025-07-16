<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlineacionPndOds extends Model
{
    use HasFactory;

    protected $table = 'alineaciones_pnd_ods';

    protected $fillable = [
        'objetivo_estrategico_id',
        'pnd_id',
        'ods_id',
        'indicador',
        'justificacion',
    ];

    // Relaciones

    public function objetivoEstrategico()
    {
        return $this->belongsTo(ObjetivoEstrategico::class);
    }

    public function pnd()
    {
        return $this->belongsTo(PndObjetivo::class, 'pnd_id');
    }

    public function ods()
    {
        return $this->belongsTo(OdsObjetivo::class, 'ods_id');
    }
}
