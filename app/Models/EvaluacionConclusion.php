<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluacionConclusion extends Model
{
    protected $fillable = ['proyecto_id', 'observaciones', 'advertencias', 'recomendaciones', 'user_id'];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
