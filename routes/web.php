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
    Route::get('/modulo-planificacion-institucional', [Modulo1Controller::class, 'index'])
        ->middleware('can:Permisos de planificación institucional')
        ->name('modulo1.dashboard');

    // Módulo 2: Validación de Planes
    Route::get('/modulo-validacion-planes', [Modulo2Controller::class, 'index'])
        ->middleware('can:Permisos de validación de planes')
        ->name('modulo2.dashboard');

    // Módulo 3: Gestión de Proyectos
    Route::get('/modulo-gestion-proyectos', [Modulo3Controller::class, 'index'])
        ->middleware('can:Permisos de gestión de proyectos')
        ->name('modulo3.dashboard');

    // Módulo 4: Priorización y Viabilidad
    Route::get('/modulo-priorizacion-viabilidad', [Modulo4Controller::class, 'index'])
        ->middleware('can:Permisos de priorización y viabilidad')
        ->name('modulo4.dashboard');

    // Módulo 5: Asignación Presupuestaria
    Route::get('/modulo-asignacion-presupuestaria', [Modulo5Controller::class, 'index'])
        ->middleware('can:Permisos de asignación presupuestaria')
        ->name('modulo5.dashboard');

    // Módulo 6: Ejecución y Seguimiento
    Route::get('/modulo-ejecucion-seguimiento', [Modulo6Controller::class, 'index'])
        ->middleware('can:Permisos de ejecución y seguimiento')
        ->name('modulo6.dashboard');

    // Módulo 7: Evaluación Final y Cierre
    Route::get('/modulo-evaluacion-final', [Modulo7Controller::class, 'index'])
        ->middleware('can:Permisos de evaluación final y cierre')
        ->name('modulo7.dashboard');

    // Módulo 8: Administración y Seguridad
    Route::get('/modulo-administracion-seguridad', [Modulo8Controller::class, 'index'])
        ->middleware(['auth', 'can:Permisos de auditoria'])
        ->name('modulo8.dashboard');
    Route::prefix('modulo-administracion-seguridad')->middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('roles', RolController::class)->names('roles');
    Route::resource('permisos', PermisoController::class)->names('permisos');
    Route::resource('bitacora', BitacoraController::class)->only(['index', 'show']);
    Route::resource('configuracion', ConfiguracionController::class)->only(['index', 'update']);
    });

});
require __DIR__.'/auth.php';
