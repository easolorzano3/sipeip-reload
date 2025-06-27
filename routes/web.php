<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Modulo8Controller;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\ConfiguracionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/modulo-administracion-seguridad', [Modulo8Controller::class, 'dashboard'])->name('modulo8.dashboard');
    Route::get('/modulo-administracion-seguridad/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/modulo-administracion-seguridad/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/modulo-administracion-seguridad/permisos', [PermisoController::class, 'index'])->name('permisos.index');
    Route::get('/modulo-administracion-seguridad/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::get('/modulo-administracion-seguridad/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
});







require __DIR__.'/auth.php';
