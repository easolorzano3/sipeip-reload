<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Modulo1Controller;
use App\Http\Controllers\Modulo1\AlineacionPndOdsController;
use App\Http\Controllers\Modulo1\IndicadorController;
use App\Http\Controllers\Modulo1\MetaController;

use App\Http\Controllers\Modulo2Controller;
use App\Http\Controllers\Modulo3Controller;
use App\Http\Controllers\Modulo4Controller;
use App\Http\Controllers\Modulo5Controller;
use App\Http\Controllers\Modulo6Controller;
use App\Http\Controllers\Modulo7Controller;
use App\Http\Controllers\Modulo8Controller;
use App\Http\Controllers\Modulo8\UsuarioController;
use App\Http\Controllers\Modulo8\RolController;
use App\Http\Controllers\Modulo8\PermisoController;
use App\Http\Controllers\Modulo8\BitacoraController;
use App\Http\Controllers\Modulo8\ConfiguracionController;

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

    // Perfil de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Módulo 1 - Planificación Institucional
Route::get('/modulo-planificacion-institucional', [Modulo1Controller::class, 'index'])
    ->middleware('can:ver modulo planificación institucional')
    ->name('modulo1.dashboard');

Route::prefix('modulo1')->middleware(['auth'])->group(function () {

    Route::resource('planes', App\Http\Controllers\Modulo1\PlanInstitucionalController::class);
    Route::resource('objetivos', App\Http\Controllers\Modulo1\ObjetivoEstrategicoController::class);
    
    Route::resource('alineaciones-pnd-ods', AlineacionPndOdsController::class)
        ->parameters(['alineaciones-pnd-ods' => 'alineacion_pnd_ods']);

    Route::resource('metas', MetaController::class);

    // Indicadores anidados correctamente dentro de metas
    Route::prefix('metas/{meta}')->group(function () {
        Route::get('indicadores', [IndicadorController::class, 'index'])->name('indicadores.index');
        Route::get('indicadores/create', [IndicadorController::class, 'create'])->name('indicadores.create');
        Route::post('indicadores', [IndicadorController::class, 'store'])->name('indicadores.store');
        Route::get('indicadores/{indicador}/edit', [IndicadorController::class, 'edit'])->name('indicadores.edit');
        Route::put('indicadores/{indicador}', [IndicadorController::class, 'update'])->name('indicadores.update');
        Route::delete('indicadores/{indicador}', [IndicadorController::class, 'destroy'])->name('indicadores.destroy');
    });

    
    // Módulo 2 - Validación de Planes
    Route::get('/modulo-validacion-planes', [Modulo2Controller::class, 'index'])
        ->middleware('can:ver modulo validación de planes')
        ->name('modulo2.dashboard');

    // Módulo 3 - Gestión de Proyectos
    Route::get('/modulo-gestion-proyectos', [Modulo3Controller::class, 'index'])
        ->middleware('can:ver modulo proyectos')
        ->name('modulo3.dashboard');

    // Módulo 4 - Priorización y Viabilidad
    Route::get('/modulo-priorizacion-viabilidad', [Modulo4Controller::class, 'index'])
        ->middleware('can:ver modulo priorización y viabilidad')
        ->name('modulo4.dashboard');

    // Módulo 5 - Asignación Presupuestaria
    Route::get('/modulo-asignacion-presupuestaria', [Modulo5Controller::class, 'index'])
        ->middleware('can:ver modulo asignación presupuestaria')
        ->name('modulo5.dashboard');

    // Módulo 6 - Ejecución y Seguimiento
    Route::get('/modulo-ejecucion-seguimiento', [Modulo6Controller::class, 'index'])
        ->middleware('can:ver modulo ejecución y seguimiento')
        ->name('modulo6.dashboard');

    // Módulo 7 - Evaluación Final y Cierre
    Route::get('/modulo-evaluacion-final', [Modulo7Controller::class, 'index'])
        ->middleware('can:ver modulo evaluación y cierre')
        ->name('modulo7.dashboard');

    // Módulo 8 - Administración y Seguridad
    Route::get('/modulo-administracion-seguridad', [Modulo8Controller::class, 'index'])
        ->middleware('can:ver modulo administración y seguridad')
        ->name('modulo8.dashboard');

    // Submódulos del Módulo 8
    Route::prefix('modulo-administracion-seguridad')->middleware(['auth'])->group(function () {
        Route::resource('usuarios', UsuarioController::class);
        Route::resource('roles', RolController::class)->names('roles');
        Route::resource('permisos', PermisoController::class)->names('permisos');
        Route::resource('bitacora', BitacoraController::class)->only(['index', 'show']);
        Route::resource('configuracion', ConfiguracionController::class)->only(['index', 'update']);
    });
});
});
require __DIR__.'/auth.php';
