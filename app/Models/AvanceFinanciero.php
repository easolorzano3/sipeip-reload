<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvanceFinanciero extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'componente',
        'valor_ejecutado',
        'fecha_corte',
        'usuario_id',
    ];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class, 'proyecto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
