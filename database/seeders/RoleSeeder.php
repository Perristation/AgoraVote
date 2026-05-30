<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'Usuario administrador con acceso completo a la gestión del sistema.']
        );

        Role::firstOrCreate(
            ['name' => 'votante'],
            ['description' => 'Usuario autorizado para participar en las votaciones asignadas.']
        );

        Role::firstOrCreate(
            ['name' => 'supervisor'],
            ['description' => 'Usuario con permisos de consulta y seguimiento de resultados.']
        );
    }
}