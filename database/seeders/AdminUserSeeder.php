<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@agoravote.test'],
            [
                'name' => 'Carlos de Martín Juan',
                'password' => Hash::make('password'),
            ]
        );

        $adminRole = Role::where('name', 'admin')->first();

        if ($adminRole) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        $adminCategory = Category::where('name', 'Administración')->first();

        if ($adminCategory) {
            $admin->categories()->syncWithoutDetaching([
                $adminCategory->id => ['assigned_at' => now()],
            ]);
        }
    }
}