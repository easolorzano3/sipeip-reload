<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PoliticaNacional;
use Illuminate\Support\Carbon;

class PoliticaNacionalSeeder extends Seeder
{
    public function run(): void
    {
        PoliticaNacional::create([
            'nombre' => 'Educación para Todos',
            'descripcion' => 'Promueve la inclusión y calidad educativa a nivel nacional.',
            'estado' => 'activo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        PoliticaNacional::create([
            'nombre' => 'Transformación Digital',
            'descripcion' => 'Fortalecer la infraestructura tecnológica del sector público.',
            'estado' => 'activo',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
