<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetaProyecto extends Model
{
    protected $table = 'meta_proyecto';
    protected $fillable = ['meta_id', 'proyecto_id'];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }
}
