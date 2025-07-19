<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    protected $table = 'resoluciones'; 

    protected $fillable = ['plan_id', 'numero', 'fecha', 'archivo', 'user_id'];

    public function plan()
    {
        return $this->belongsTo(PlanInstitucional::class, 'plan_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
