<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Election;
use App\Models\ElectionSection;
use App\Models\Role;
use App\Models\User;
use App\Models\VoteOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $votanteRole = Role::where('name', 'votante')->first();

        $alumnado = Category::where('name', 'Alumnado')->first();
        $profesorado = Category::where('name', 'Profesorado')->first();
        $familias = Category::where('name', 'Familias')->first();
        $administracion = Category::where('name', 'Administración')->first();

        $admin = User::firstOrCreate(
            ['email' => 'admin@agoravote.test'],
            [
                'name' => 'Administrador AgoraVote',
                'password' => Hash::make('password'),
            ]
        );

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        $admin->categories()->syncWithoutDetaching([
            $administracion->id => ['assigned_at' => now()],
        ]);

        $alumno = User::firstOrCreate(
            ['email' => 'alumno@agoravote.test'],
            [
                'name' => 'Alumno Demo',
                'password' => Hash::make('password'),
            ]
        );

        $alumno->roles()->syncWithoutDetaching([$votanteRole->id]);
        $alumno->categories()->syncWithoutDetaching([
            $alumnado->id => ['assigned_at' => now()],
        ]);

        $profesor = User::firstOrCreate(
            ['email' => 'profesor@agoravote.test'],
            [
                'name' => 'Profesor Demo',
                'password' => Hash::make('password'),
            ]
        );

        $profesor->roles()->syncWithoutDetaching([$votanteRole->id]);
        $profesor->categories()->syncWithoutDetaching([
            $profesorado->id => ['assigned_at' => now()],
        ]);

        $familia = User::firstOrCreate(
            ['email' => 'familia@agoravote.test'],
            [
                'name' => 'Familia Demo',
                'password' => Hash::make('password'),
            ]
        );

        $familia->roles()->syncWithoutDetaching([$votanteRole->id]);
        $familia->categories()->syncWithoutDetaching([
            $familias->id => ['assigned_at' => now()],
        ]);

        $election = Election::firstOrCreate(
            ['title' => 'Elección Consejo Escolar 2026'],
            [
                'created_by' => $admin->id,
                'description' => 'Votación para elegir representantes del consejo escolar del centro.',
                'start_at' => now(),
                'end_at' => now()->addDays(7),
                'status' => 'active',
                'is_anonymous' => true,
                'show_realtime_results' => false,
                'voting_type' => 'single',
                'max_selections' => 1,
            ]
        );

        $election->categories()->syncWithoutDetaching([
            $alumnado->id,
            $profesorado->id,
            $familias->id,
        ]);

        $section = ElectionSection::firstOrCreate(
            [
                'election_id' => $election->id,
                'title' => 'Representantes del alumnado',
            ],
            [
                'description' => 'Candidatos disponibles para representar al alumnado en el consejo escolar.',
                'max_selections' => 1,
            ]
        );

        $options = [
            'Ana García',
            'Marcos Pérez',
            'Laura Sánchez',
            'David Ruiz',
        ];

        foreach ($options as $index => $optionText) {
            VoteOption::firstOrCreate(
                [
                    'election_section_id' => $section->id,
                    'text' => $optionText,
                ],
                [
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]
            );
        }
    }
}