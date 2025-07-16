<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObjetivoEstrategico;
use App\Models\EjeEstrategico;
use App\Models\PoliticaNacional;

class ObjetivoEstrategicoSeeder extends Seeder
{
    public function run(): void
    {
        $eje = EjeEstrategico::first();
        $politica = PoliticaNacional::first();

        if ($eje && $politica) {
            ObjetivoEstrategico::create([
                'plan_institucional_id' => 4, // Asegúrate que existe este plan
                'eje_estrategico_id' => $eje->id,
                'politica_nacional_id' => $politica->id,
                'nombre' => 'Reducir la deserción escolar',
                'descripcion' => 'Implementar estrategias para mejorar la permanencia estudiantil.',
                'periodo_inicio' => '2024-01-01',
                'periodo_fin' => '2028-12-31',
                'estado' => 'activo',
            ]);
        } else {
            $this->command->warn('No se encontraron registros de Eje Estratégico o Política Nacional para asociar.');
        }
    }
}
