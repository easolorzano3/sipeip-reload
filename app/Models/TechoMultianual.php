<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechoMultianual extends Model
{
    protected $table = 'techos_multianuales';  // ← nombre correcto de la tabla
    protected $fillable = ['proyecto_id', 'anio', 'monto'];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }
}
