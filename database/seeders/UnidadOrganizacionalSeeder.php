<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadOrganizacionalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('unidad_organizacionales')->upsert([
            ['nombre' => 'Dirección General'],
            ['nombre' => 'Dirección de Planificación'],
            ['nombre' => 'Unidad Técnica de Proyectos'],
            ['nombre' => 'Departamento Financiero'],
            ['nombre' => 'Área de Sistemas'],
            ['nombre' => 'Unidad de Auditoría Interna'],
            ['nombre' => 'Dirección de Evaluación Institucional'],
        ], ['nombre'], ['nombre']);

    }
}
