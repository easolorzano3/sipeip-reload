<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {
        // Crear rol de Administrador
        $adminRole = Role::firstOrCreate(['name' => 'Administrador']);

        // Lista de permisos base (uno por módulo, puedes ampliarla luego)
        $permisos = [
            'ver modulo planificación institucional',
            'ver modulo validación de planes',
            'ver modulo proyectos',
            'ver modulo priorización y viabilidad',
            'ver modulo asignación presupuestaria',
            'ver modulo ejecución y seguimiento',
            'ver modulo evaluación y cierre',
            'ver modulo administración y seguridad',
        ];


        // Crear y asignar permisos al rol
        foreach ($permisos as $permiso) {
            $p = Permission::firstOrCreate(['name' => $permiso]);
            $adminRole->givePermissionTo($p);
        }
    }
}
