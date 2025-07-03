<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulo;

class ModuloSeeder extends Seeder
{
    public function run(): void
    {
        $modulos = [
            ['nombre' => 'Planificación Institucional', 'codigo' => 'MOD1'],
            ['nombre' => 'Validación de Planes', 'codigo' => 'MOD2'],
            ['nombre' => 'Gestión de Proyectos de Inversión Pública', 'codigo' => 'MOD3'],
            ['nombre' => 'Priorización y Viabilidad de Proyectos', 'codigo' => 'MOD4'],
            ['nombre' => 'Asignación Presupuestaria', 'codigo' => 'MOD5'],
            ['nombre' => 'Ejecución y Seguimiento', 'codigo' => 'MOD6'],
            ['nombre' => 'Evaluación Final y Cierre', 'codigo' => 'MOD7'],
            ['nombre' => 'Administración y Seguridad', 'codigo' => 'MOD8'],
        ];

        foreach ($modulos as $modulo) {
            Modulo::create($modulo);
        }
    }
}
