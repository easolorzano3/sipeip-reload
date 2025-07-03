<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
}
