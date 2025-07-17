<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';
    protected $fillable = ['meta_id', 'nombre', 'unidad', 'frecuencia', 'valor_referencia', 'valor_meta', 'metodologia'];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}