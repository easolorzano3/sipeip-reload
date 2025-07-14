<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NuevasUnidadesOrganizativasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('unidad_organizacionales')->insert([
            [
                'nombre' => 'Dirección de Evaluación Institucional',
                'codigo' => 'DEI001',
                'unidad_padre_id' => 1,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Dirección de Validación Técnica del SNP',
                'codigo' => 'DVT001',
                'unidad_padre_id' => 1,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Unidad Ejecutora de Proyectos',
                'codigo' => 'UEP001',
                'unidad_padre_id' => 1,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Unidad Institucional de Consulta',
                'codigo' => 'UIC001',
                'unidad_padre_id' => 1,
                'estado' => 'activo'
            ],
        ]);
    }
}
