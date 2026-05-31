<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ElectionController;
use App\Http\Controllers\Admin\ElectionSectionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| Rutas de administración de votaciones
|--------------------------------------------------------------------------
*/

Route::get('/admin/votaciones', [ElectionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin.elections.index');

Route::get('/admin/votaciones/crear', [ElectionController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('admin.elections.create');

Route::post('/admin/votaciones', [ElectionController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('admin.elections.store');

Route::get('/admin/votaciones/{election}', [ElectionController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('admin.elections.show');

Route::get('/admin/votaciones/{election}/secciones/crear', [ElectionSectionController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('admin.elections.sections.create');

Route::post('/admin/votaciones/{election}/secciones', [ElectionSectionController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('admin.elections.sections.store');

/*
|--------------------------------------------------------------------------
| Perfil de usuario
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';