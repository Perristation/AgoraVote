<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Election;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::with('creator')
            ->latest()
            ->get();

        return view('admin.elections.index', compact('elections'));
    }
}