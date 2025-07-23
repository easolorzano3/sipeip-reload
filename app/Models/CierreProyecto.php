<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CierreProyecto extends Model
{
    protected $fillable = ['proyecto_id', 'fecha_cierre', 'cerrado_por', 'descripcion'];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'cerrado_por');
    }
}
