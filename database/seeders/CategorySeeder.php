<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'name' => 'Alumnado',
            'description' => 'Categoría destinada a los alumnos del centro educativo.',
        ]);

        Category::create([
            'name' => 'Profesorado',
            'description' => 'Categoría destinada al personal docente del centro.',
        ]);

        Category::create([
            'name' => 'Familias',
            'description' => 'Categoría destinada a padres, madres o tutores legales.',
        ]);

        Category::create([
            'name' => 'Administración',
            'description' => 'Categoría destinada al personal administrativo del centro.',
        ]);
    }
}