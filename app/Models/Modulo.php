<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $fillable = ['nombre', 'codigo'];

public function permisos()
    {
        return $this->belongsToMany(\Spatie\Permission\Models\Permission::class, 'modulo_permission');
    }

}
