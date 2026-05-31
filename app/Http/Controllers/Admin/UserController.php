<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['roles', 'categories'])
            ->latest()
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('admin.users.create', compact('roles', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => ['exists:roles,id'],
            'categories' => ['required', 'array', 'min:1'],
            'categories.*' => ['exists:categories,id'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->roles()->sync($validated['roles']);

        $categoriesWithPivot = [];

        foreach ($validated['categories'] as $categoryId) {
            $categoriesWithPivot[$categoryId] = [
                'assigned_at' => now(),
            ];
        }

        $user->categories()->sync($categoriesWithPivot);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'El usuario se ha creado correctamente.');
    }
}