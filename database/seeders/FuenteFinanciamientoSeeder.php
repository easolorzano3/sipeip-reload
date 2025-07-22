<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuenteFinanciamientoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fuentes_financiamiento')->insert([
            [
                'codigo' => '20',
                'nombre' => 'Recursos Fiscales',
                'descripcion' => 'Del Presupuesto General del Estado (PGE)',
                'tipo' => 'Interna',
            ],
            [
                'codigo' => '21',
                'nombre' => 'Recursos Propios o Institucionales',
                'descripcion' => 'Ingresos que genera la entidad ejecutora',
                'tipo' => 'Interna',
            ],
            [
                'codigo' => '22',
                'nombre' => 'Donaciones',
                'descripcion' => 'Ayuda económica no reembolsable',
                'tipo' => 'Externa',
            ],
            [
                'codigo' => '23',
                'nombre' => 'Crédito Externo Multilateral',
                'descripcion' => 'Préstamos de BID, BM, CAF, etc.',
                'tipo' => 'Externa',
            ],
            [
                'codigo' => '24',
                'nombre' => 'Crédito Externo Bilateral',
                'descripcion' => 'Préstamos entre gobiernos',
                'tipo' => 'Externa',
            ],
            [
                'codigo' => '25',
                'nombre' => 'Crédito Interno',
                'descripcion' => 'Préstamos de banca nacional',
                'tipo' => 'Interna',
            ],
            [
                'codigo' => '30',
                'nombre' => 'Transferencias Intergubernamentales',
                'descripcion' => 'Traspasos entre niveles de gobierno',
                'tipo' => 'Interna',
            ],
            [
                'codigo' => '50',
                'nombre' => 'Alianzas Público Privadas (APP)',
                'descripcion' => 'Inversión compartida con sector privado',
                'tipo' => 'Mixta',
            ],
            [
                'codigo' => '60',
                'nombre' => 'Otros Recursos',
                'descripcion' => 'Cualquier fuente no clasificada anterior',
                'tipo' => 'Mixta',
            ],
        ]);
    }
}
