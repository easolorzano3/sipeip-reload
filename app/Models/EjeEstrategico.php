<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjeEstrategico extends Model
{
    use HasFactory;

    protected $table = 'ejes_estrategicos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relación inversa con ObjetivoEstrategico (opcional)
    public function objetivos()
    {
        return $this->hasMany(ObjetivoEstrategico::class);
    }
}
