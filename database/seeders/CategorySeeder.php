<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::firstOrCreate(
            ['name' => 'Alumnado'],
            ['description' => 'Categoría destinada a los alumnos del centro educativo.']
        );

        Category::firstOrCreate(
            ['name' => 'Profesorado'],
            ['description' => 'Categoría destinada al personal docente del centro educativo.']
        );

        Category::firstOrCreate(
            ['name' => 'Familias'],
            ['description' => 'Categoría destinada a padres, madres o tutores legales.']
        );

        Category::firstOrCreate(
            ['name' => 'Administración'],
            ['description' => 'Categoría destinada al personal administrativo y de gestión.']
        );
    }
}