<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = ['objetivo_estrategico_id', 'nombre', 'descripcion'];

    public function objetivoEstrategico()
    {
        return $this->belongsTo(ObjetivoEstrategico::class);
    }

    public function indicadores()
    {
        return $this->hasMany(Indicador::class);
    }

    public function proyectos()
    {
        return $this->belongsToMany(ProyectoInversion::class, 'meta_proyecto', 'meta_id', 'proyecto_id')->withTimestamps();
    }
    public function objetivo()
    {
        return $this->belongsTo(ObjetivoEstrategico::class, 'objetivo_estrategico_id');
    }

}
