<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Modulo1Controller;
use App\Http\Controllers\Modulo2Controller;
use App\Http\Controllers\Modulo3Controller;
use App\Http\Controllers\Modulo4Controller;
use App\Http\Controllers\Modulo5Controller;
use App\Http\Controllers\Modulo6Controller;
use App\Http\Controllers\Modulo7Controller; // <-- Asegúrate de tener este importado
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
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulo 1 - Planificación Institucional
    Route::get('/modulo-planificacion-institucional', [Modulo1Controller::class, 'dashboard'])->name('modulo1.dashboard');

    Route::get('/modulo-validacion-planes', [Modulo2Controller::class, 'dashboard'])->name('modulo2.dashboard');

    Route::get('/modulo-proyectos-inversion', [Modulo3Controller::class, 'dashboard'])->name('modulo3.dashboard');

    Route::get('/modulo-priorizacion-viabilidad', [Modulo4Controller::class, 'dashboard'])->name('modulo4.dashboard');

    Route::get('/modulo-asignacion-presupuestaria', [Modulo5Controller::class, 'dashboard'])->name('modulo5.dashboard');

    Route::get('/modulo-ejecucion-seguimiento', [Modulo6Controller::class, 'dashboard'])->name('modulo6.dashboard');

    Route::get('/modulo-evaluacion-cierre', [Modulo7Controller::class, 'dashboard'])->name('modulo7.dashboard');

    // Módulo 8 - Administración y Seguridad
    Route::get('/modulo-administracion-seguridad', [Modulo8Controller::class, 'dashboard'])->name('modulo8.dashboard');
    Route::get('/modulo-administracion-seguridad/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/modulo-administracion-seguridad/roles', [RolController::class, 'index'])->name('roles.index');
    Route::get('/modulo-administracion-seguridad/permisos', [PermisoController::class, 'index'])->name('permisos.index');
    Route::get('/modulo-administracion-seguridad/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    Route::get('/modulo-administracion-seguridad/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');


});

require __DIR__.'/auth.php';
