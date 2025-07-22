<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvanceFisico extends Model
{
    use HasFactory;

    protected $fillable = [
        'proyecto_id',
        'fase',
        'meta_id',
        'porcentaje',
        'fecha_corte',
        'usuario_id'
    ];
    public function proyecto()
    {
        return $this->belongsTo(\App\Models\ProyectoInversion::class, 'proyecto_id');
    }

    public function meta()
    {
        return $this->belongsTo(\App\Models\Meta::class, 'meta_id');
    }

    public function usuario()
    {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }






}
