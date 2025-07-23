<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeFirmado extends Model
{
    protected $table = 'informes_firmados';

    protected $fillable = ['proyecto_id', 'archivo_pdf', 'firmado_en', 'firmado_por'];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoInversion::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'firmado_por');
    }
}
