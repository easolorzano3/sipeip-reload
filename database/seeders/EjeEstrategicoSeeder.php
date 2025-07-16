<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EjeEstrategico;

class EjeEstrategicoSeeder extends Seeder
{
    public function run(): void
    {
        EjeEstrategico::create([
            'nombre' => 'Innovación Educativa',
            'descripcion' => 'Impulsar estrategias que mejoren la calidad de la educación.',
            'estado' => 'activo',
        ]);
    }
}
