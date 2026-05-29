<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'description' => 'Usuario administrador con acceso a la gestión completa del sistema.',
        ]);

        Role::create([
            'name' => 'votante',
            'description' => 'Usuario autorizado para participar en las votaciones asignadas.',
        ]);

        Role::create([
            'name' => 'supervisor',
            'description' => 'Usuario con permiso para consultar resultados y seguimiento de votaciones.',
        ]);
    }
}