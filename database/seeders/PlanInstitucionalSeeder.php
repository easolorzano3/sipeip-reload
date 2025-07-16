<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PlanInstitucional;

class PlanInstitucionalSeeder extends Seeder
{
    public function run(): void
    {
        PlanInstitucional::create([
            'entidad' => 'Ministerio de Educación',
            'nivel_gobierno' => 'Nacional',
            'estado_institucional' => 'Activo',
            'codigo_institucional' => 'MINEDUC01',
            'nombre' => 'Plan Estratégico Institucional 2024-2028',
            'codigo_plan' => 'PEI2024',
            'anio_inicio' => '2024-01-01',
            'anio_fin' => '2028-12-31',
            'unidad_id' => 1, // Asegúrate de que esta unidad existe en la tabla unidad_organizacionales
            'estado' => 'borrador',
        ]);
    }
}
