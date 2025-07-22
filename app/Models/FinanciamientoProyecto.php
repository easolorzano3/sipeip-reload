<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanciamientoProyecto extends Model
{
    use HasFactory;

    protected $table = 'financiamientos_proyecto';

    protected $fillable = ['proyecto_id', 'fuente_id','anio','monto'];

    public function proyecto()
    {
        return $this->belongsTo(\App\Models\ProyectoInversion::class, 'proyecto_id');
    }

    public function fuente()
    {
        return $this->belongsTo(\App\Models\FuenteFinanciamiento::class, 'fuente_id');
    }




}
