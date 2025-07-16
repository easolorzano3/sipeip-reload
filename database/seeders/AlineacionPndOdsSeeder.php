<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AlineacionPndOds;

class AlineacionPndOdsSeeder extends Seeder
{
    public function run(): void
    {
        AlineacionPndOds::create([
            'objetivo_estrategico_id' => 1, // ID del objetivo estratégico que ya tienes creado
            'pnd_id' => 1,                  // ID del primer objetivo PND (OBJ-1)
            'ods_id' => 1,                  // ID del primer ODS (ODS-1)
            'indicador' => ''              // Campo vacío
        ]);
    }
}
