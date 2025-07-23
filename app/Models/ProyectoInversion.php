<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectoInversion extends Model
{
    use HasFactory;

    protected $table = 'proyectos_inversion';

    protected $fillable = [
        'programa_id',
        'plan_id',
        'actividad_poa_id',
        'nombre',
        'codigo',
        'objetivo_general',
        'monto_estimado',
        'cobertura',
        'cronograma_inicio',
        'cronograma_fin',
        'estado',
        'created_by',
        
    ];

    // 🔁 Relación: pertenece a un programa (puede ser null)
    public function programa()
    {
        return $this->belongsTo(ProgramaInversion::class, 'programa_id');
    }

    // Relación: pertenece a un plan institucional
    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }

    // Relación: pertenece a una actividad POA (opcional)
    public function actividad()
    {
        return $this->belongsTo(ActividadPoa::class, 'actividad_poa_id');
    }

    // Relación con el usuario creador
    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function dictamenTecnico()
    {
        return $this->hasOne(DictamenTecnico::class, 'proyecto_id');
    }


    public function asignacionPresupuestaria()
    {
        return $this->hasOne(\App\Models\AsignacionPresupuestaria::class, 'proyecto_id');
    }

    public function financiamientos()
    {
        return $this->hasMany(\App\Models\FinanciamientoProyecto::class, 'proyecto_id');
    }

    public function avancesFinancieros() {
    return $this->hasMany(AvanceFinanciero::class, 'proyecto_id');
    }

    public function avancesFisicos() {
        return $this->hasMany(AvanceFisico::class, 'proyecto_id');
    }

    public function evidencias()
    {
        return $this->hasMany(DocumentoEvidencia::class, 'proyecto_id');
    }

    public function planificacionesEjecutivas()
    {
        return $this->hasMany(PlanificacionEjecutiva::class, 'proyecto_id');
    }

    public function cierre()
    {
        return $this->hasOne(CierreProyecto::class, 'proyecto_id');
    }

    public function informeFirmado()
    {
        return $this->hasOne(InformeFirmado::class, 'proyecto_id');
    }

   public function lecciones()
    {
        return $this->hasMany(LeccionAprendida::class, 'proyecto_id'); // Asegúrate que esta sea la clave foránea correcta
    }

    public function metas()
    {
        return $this->belongsToMany(Meta::class, 'meta_proyecto', 'proyecto_id', 'meta_id')->withTimestamps();
    }
}
