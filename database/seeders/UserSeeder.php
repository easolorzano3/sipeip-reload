<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UnidadOrganizacional;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear o encontrar la unidad organizacional
        $unidad = UnidadOrganizacional::firstOrCreate([
            'nombre' => 'Dirección General de Pruebas',
        ]);

        // Crear el usuario administrador
        $usuario = User::firstOrCreate(
            ['email' => 'easolorzano3@utpl.edu.ec'],
            [
                'nombres' => 'Eduardo',
                'apellidos' => 'Solórzano',
                'password' => bcrypt('admin123'),
                'estado' => 'Activo',
                'unidad_organizacional_id' => $unidad->id,
            ]
        );

        // Crear el rol 'Administrador' si no existe
        $rol = Role::firstOrCreate(['name' => 'Administrador']);

        // Asignar el rol al usuario
        if (!$usuario->hasRole('Administrador')) {
            $usuario->assignRole($rol);
        }
    }
}
