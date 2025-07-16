<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadOrganizacionalSeeder extends Seeder
{
    public function run(): void
    {
        $unidades = [
            ['nombre' => 'Dirección General'],
            ['nombre' => 'Dirección de Planificación'],
            ['nombre' => 'Unidad Técnica de Proyectos'],
            ['nombre' => 'Departamento Financiero'],
            ['nombre' => 'Área de Sistemas'],
            ['nombre' => 'Unidad de Auditoría Interna'],
            ['nombre' => 'Dirección de Evaluación Institucional'],
        ];

        foreach ($unidades as $unidad) {
            DB::table('unidad_organizacionales')->updateOrInsert(
                ['nombre' => $unidad['nombre']], // condición de búsqueda
                ['nombre' => $unidad['nombre']]  // datos a insertar si no existe
            );
        }
    }
}
