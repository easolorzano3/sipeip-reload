<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(UnidadOrganizacionalSeeder::class);
        $this->call(NuevasUnidadesOrganizativasSeeder::class);
        $this->call([UnidadOrganizacionalSeeder::class,RolesPermisosSeeder::class,UserSeeder::class,]);
        $this->call(PlanInstitucionalSeeder::class);
        $this->call([
        EjeEstrategicoSeeder::class,
        PoliticaNacionalSeeder::class,
        ObjetivoEstrategicoSeeder::class,]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
