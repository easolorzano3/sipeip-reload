<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuenteFinanciamiento extends Model
{
    protected $table = 'fuentes_financiamiento';
    protected $fillable = [
        'nombre',
        'tipo',
        'descripcion',
    ];

    public function proyectos()
    {
        return $this->hasMany(FinanciamientoProyecto::class, 'fuente_id');
    }

    public function financiamientos()
    {
        return $this->hasMany(\App\Models\FinanciamientoProyecto::class, 'fuente_id');
    }


}
