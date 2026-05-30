<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $categories = Category::all();
        $usersCount = User::count();

        return view('admin.dashboard', compact('roles', 'categories', 'usersCount'));
    }
}