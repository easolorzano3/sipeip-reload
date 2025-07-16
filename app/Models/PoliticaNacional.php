<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticaNacional extends Model
{
    use HasFactory;

    protected $table = 'politicas_nacionales';

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    // Relación opcional si se usa
    public function objetivos()
    {
        return $this->hasMany(ObjetivoEstrategico::class);
    }
}
