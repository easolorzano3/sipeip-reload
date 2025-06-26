<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadOrganizacionalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('unidad_organizacionales')->insert([
            ['nombre' => 'Dirección de Planificación'],
            ['nombre' => 'Unidad Técnica de Proyectos'],
            ['nombre' => 'Departamento Financiero'],
            ['nombre' => 'Área de Sistemas']
        ]);
    }
}
