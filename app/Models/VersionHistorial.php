<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VersionHistorial extends Model
{
    use HasFactory;

    protected $table = 'versiones_historial';

    protected $fillable = [
        'plan_id',
        'accion',
        'descripcion',
        'usuario_id',
        'fecha_accion',
    ];

    protected $dates = ['fecha_accion']; // 👈 agrega esto
    // Relación con el Plan Institucional
    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }

    // Relación con el Usuario que hizo la acción
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
