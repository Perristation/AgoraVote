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
        $admin = User::create([
            'name' => 'Carlos de Martín Juan',
            'email' => 'admin@agoravote.test',
            'password' => Hash::make('password'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $admin->roles()->attach($adminRole->id);

        $adminCategory = Category::where('name', 'Administración')->first();
        $admin->categories()->attach($adminCategory->id, [
            'assigned_at' => now(),
        ]);
    }
}