<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeccionAprendida extends Model
{
    protected $fillable = ['proyecto_id', 'tipo', 'descripcion', 'user_id'];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
