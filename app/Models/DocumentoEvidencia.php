<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoEvidencia extends Model
{
    use HasFactory;

    protected $table = 'documentos_evidencias';

    protected $fillable = [
        'proyecto_id',
        'usuario_id',
        'tipo',
        'descripcion',
        'archivo',
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
