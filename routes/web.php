<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Módulo 1
use App\Http\Controllers\Modulo1Controller;
use App\Http\Controllers\Modulo1\PlanInstitucionalController;
use App\Http\Controllers\Modulo1\ObjetivoEstrategicoController;
use App\Http\Controllers\Modulo1\AlineacionPndOdsController;
use App\Http\Controllers\Modulo1\MetaController;
use App\Http\Controllers\Modulo1\IndicadorController;
use App\Http\Controllers\Modulo1\ActividadPoaController;
use App\Http\Controllers\Modulo1\DocumentoRespaldoController;
use App\Http\Controllers\Modulo1\EnvioRevisionController;
use App\Http\Controllers\Modulo1\VersionHistorialController;
use App\Http\Controllers\Modulo1\ResolucionController;

// Módulo 2 al 8
use App\Http\Controllers\Modulo2Controller;
use App\Http\Controllers\Modulo2\ValidacionPlanController;


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

// Perfil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Módulo 1 - Planificación Institucional
Route::prefix('modulo-planificacion-institucional')->middleware(['auth'])->group(function () {
    Route::get('/', [Modulo1Controller::class, 'index'])
        ->middleware('can:ver modulo planificación institucional')
        ->name('modulo1.dashboard');

    Route::resource('planes', PlanInstitucionalController::class);
    Route::resource('objetivos', ObjetivoEstrategicoController::class);
    Route::resource('alineaciones-pnd-ods', AlineacionPndOdsController::class)
        ->parameters(['alineaciones-pnd-ods' => 'alineacion_pnd_ods']);
    Route::resource('metas', MetaController::class);

    Route::prefix('metas/{meta}')->group(function () {
        Route::get('indicadores', [IndicadorController::class, 'index'])->name('indicadores.index');
        Route::get('indicadores/create', [IndicadorController::class, 'create'])->name('indicadores.create');
        Route::post('indicadores', [IndicadorController::class, 'store'])->name('indicadores.store');
        Route::get('indicadores/{indicador}/edit', [IndicadorController::class, 'edit'])->name('indicadores.edit');
        Route::put('indicadores/{indicador}', [IndicadorController::class, 'update'])->name('indicadores.update');
        Route::delete('indicadores/{indicador}', [IndicadorController::class, 'destroy'])->name('indicadores.destroy');
    });

    Route::resource('actividades', ActividadPoaController::class)->names('actividades');
    Route::resource('documentos', DocumentoRespaldoController::class);
    Route::resource('revision', EnvioRevisionController::class)->names('revision');

    Route::get('versiones', [VersionHistorialController::class, 'index'])->name('modulo1.versiones.index');
    Route::get('versiones-historial/{plan_id}/reporte', [VersionHistorialController::class, 'generarPDF'])->name('versiones.generar-pdf');

    Route::prefix('resoluciones')->group(function () {
        Route::get('/', [ResolucionController::class, 'index'])->name('resoluciones.index');
        Route::get('crear', [ResolucionController::class, 'create'])->name('resoluciones.create');
        Route::post('/', [ResolucionController::class, 'store'])->name('resoluciones.store');
    });
});

// Módulo 2 - Validación de Planes
// Redireccionar acceso directo al módulo 2 hacia el listado de validaciones
Route::redirect('/modulo-validacion-planes', '/modulo-validacion-planes/validaciones');
Route::prefix('modulo-validacion-planes')->middleware(['auth'])->group(function () {
    Route::resource('validaciones', ValidacionPlanController::class)->names('validaciones');
});




// Módulo 3 - Gestión de Proyectos
Route::get('/modulo-gestion-proyectos', [Modulo3Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo proyectos'])
    ->name('modulo3.dashboard');

// Módulo 4 - Priorización y Viabilidad
Route::get('/modulo-priorizacion-viabilidad', [Modulo4Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo priorización y viabilidad'])
    ->name('modulo4.dashboard');

// Módulo 5 - Asignación Presupuestaria
Route::get('/modulo-asignacion-presupuestaria', [Modulo5Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo asignación presupuestaria'])
    ->name('modulo5.dashboard');

// Módulo 6 - Ejecución y Seguimiento
Route::get('/modulo-ejecucion-seguimiento', [Modulo6Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo ejecución y seguimiento'])
    ->name('modulo6.dashboard');

// Módulo 7 - Evaluación Final y Cierre
Route::get('/modulo-evaluacion-final', [Modulo7Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo evaluación y cierre'])
    ->name('modulo7.dashboard');

// Módulo 8 - Administración y Seguridad
Route::get('/modulo-administracion-seguridad', [Modulo8Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo administración y seguridad'])
    ->name('modulo8.dashboard');

Route::prefix('modulo-administracion-seguridad')->middleware(['auth'])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('roles', RolController::class)->names('roles');
    Route::resource('permisos', PermisoController::class)->names('permisos');
    Route::resource('bitacora', BitacoraController::class)->only(['index', 'show']);
    Route::resource('configuracion', ConfiguracionController::class)->only(['index', 'update']);
});

// Autenticación
require __DIR__.'/auth.php';
