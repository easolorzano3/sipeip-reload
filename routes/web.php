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

// Módulo 2
use App\Http\Controllers\Modulo2Controller;
use App\Http\Controllers\Modulo2\ValidacionPlanController;

// Módulo 3
use App\Http\Controllers\Modulo3Controller;
use App\Http\Controllers\Modulo3\ProgramaInversionController;
use App\Http\Controllers\Modulo3\ProyectoInversionController;

use App\Http\Controllers\Modulo4Controller;
use App\Http\Controllers\Modulo4\DictamenTecnicoController;

use App\Http\Controllers\Modulo5Controller;
use App\Http\Controllers\Modulo5\AsignacionPresupuestariaController;
use App\Http\Controllers\Modulo5\TechoMultianualController;
use App\Http\Controllers\Modulo5\FinanciamientoProyectoController;
use App\Http\Controllers\Modulo5\EnvioSigefController;

use App\Http\Controllers\Modulo6Controller;
use App\Http\Controllers\Modulo6\AvanceFisicoController;
use App\Http\Controllers\Modulo6\AvanceFinancieroController;
use App\Http\Controllers\Modulo6\ReporteAvanceController;
use App\Http\Controllers\Modulo6\DocumentoEvidenciaController;
use App\Http\Controllers\Modulo6\PlanificacionEjecutivaController;


use App\Http\Controllers\Modulo7Controller;
use App\Http\Controllers\Modulo7\EvaluacionFinalController;


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

Route::prefix('modulo3')->middleware(['auth'])->group(function () {
    Route::get('planes/{id}/programas', [ProgramaInversionController::class, 'indexPorPlan'])
        ->name('programas.indexPorPlan');
    Route::get('programas/{id}/proyectos', [ProyectoInversionController::class, 'indexPorPrograma'])
        ->name('proyectos.indexPorPrograma');

    Route::resource('programas', ProgramaInversionController::class)->names('programas');
    Route::resource('proyectos', ProyectoInversionController::class)->names('proyectos');

    //RELACION PERTENECIENTE AL MODULO 6
    Route::get('modulo3/proyectos-inversion/{id}', [ProyectoInversionController::class, 'show'])->name('proyectos-inversion.show');

});


// Módulo 4 - Priorización y Viabilidad
// Ruta personalizada para mostrar el index
Route::get('/modulo-priorizacion-viabilidad', [DictamenTecnicoController::class, 'index'])->name('modulo4.priorizacion.index');

// CRUD completo para dictámenes
Route::resource('modulo4/dictamenes', DictamenTecnicoController::class);

// Módulo 5 - Asignación Presupuestaria
Route::get('/modulo-asignacion-presupuestaria', [AsignacionPresupuestariaController::class, 'index'])
    ->middleware(['auth', 'can:ver modulo asignación presupuestaria'])
    ->name('modulo5.dashboard');
Route::prefix('modulo-asignacion-presupuestaria')->group(function () {
    Route::get('/techos/{id}/create', [TechoMultianualController::class, 'create'])->name('techos.create');
    Route::post('/techos', [TechoMultianualController::class, 'store'])->name('techos.store');
    // Asignación de fuentes de financiamiento
    Route::get('proyectos/{proyecto}/asignar-fuentes', [FinanciamientoProyectoController::class, 'create'])->name('financiamientos.create');
    Route::post('financiamientos', [FinanciamientoProyectoController::class, 'store'])->name('financiamientos.store');
    Route::get('modulo-asignacion-presupuestaria/proyectos/{proyecto}/ver-financiamiento', [FinanciamientoProyectoController::class, 'show'])->name('financiamientos.show');
    Route::get('/modulo-asignacion-presupuestaria/financiamientos/{id}/edit', [FinanciamientoProyectoController::class, 'edit'])->name('financiamientos.edit');
    Route::put('/modulo-asignacion-presupuestaria/financiamientos/{id}', [FinanciamientoProyectoController::class, 'update'])->name('financiamientos.update');
    Route::delete('/modulo-asignacion-presupuestaria/financiamientos/{id}', [FinanciamientoProyectoController::class, 'destroy'])->name('financiamientos.destroy');
    Route::get('proyectos/{id}/certificacion', [FinanciamientoProyectoController::class, 'generarCertificacion'])->name('modulo5.proyectos.certificacion');

    Route::prefix('modulo5')->middleware(['auth'])->group(function () {
        Route::get('envios-sigef', [EnvioSigefController::class, 'index'])->name('envios-sigef.index');
        Route::get('envios-sigef/{proyecto_id}/crear', [EnvioSigefController::class, 'create'])->name('envios-sigef.create');
        Route::post('envios-sigef', [EnvioSigefController::class, 'store'])->name('envios-sigef.store');
    
        Route::post('modulo5/proyectos/{proyecto}/enviar-esigef', [FinanciamientoProyectoController::class, 'enviarEsigef'])->name('financiamientos.enviarEsigef');
        Route::get('proyectos/{proyecto}/enviar-esigef', [EnvioSigefController::class, 'formulario'])->name('esigef.formulario');
    });

    // routes/web.php

    Route::get('/modulo-asignacion-presupuestaria/proyectos/{proyecto}/show', [App\Http\Controllers\Modulo5\FinanciamientoProyectoController::class, 'show'])
        ->name('modulo5.proyectos.show');



});

// Módulo 6 - Ejecución y Seguimiento
Route::get('/modulo-ejecucion-seguimiento', [Modulo6Controller::class, 'dashboard'])
    ->middleware(['auth', 'can:ver modulo ejecución y seguimiento'])
    ->name('modulo6.dashboard');

Route::resource('modulo6/avance-financiero', AvanceFinancieroController::class)
    ->middleware(['auth'])
    ->names('avance-financiero');

Route::get('avance-financiero/{proyecto}/certificacion', [AvanceFinancieroController::class, 'generarCertificacion'])
    ->name('modulo6.avance-financiero.certificacion')
    ->middleware(['auth']);


    Route::resource('modulo6/avance-fisico', AvanceFisicoController::class)->middleware(['auth']);

// Módulo 6 - Visualización de seguimiento por proyecto
Route::get('/modulo6/proyectos/nombre/{nombre}', [Modulo6Controller::class, 'showPorNombre'])
    ->name('modulo6.proyectos.showPorNombre')
    ->middleware(['auth']);

Route::get('/modulo6/reporte-avances', [App\Http\Controllers\Modulo6Controller::class, 'reporteAvances'])
    ->name('modulo6.reporte-avances')
    ->middleware(['auth']);

Route::get('/modulo6/reporte-avances/pdf', [App\Http\Controllers\Modulo6\ReporteAvanceController::class, 'generarPDF'])
    ->name('reporte-avances.generar-pdf')
    ->middleware(['auth']);

Route::resource('modulo6/documentos-evidencias', DocumentoEvidenciaController::class)
    ->names('documentos-evidencias')
    ->middleware(['auth']);

Route::post('/modulo6/planificaciones', [PlanificacionEjecutivaController::class, 'store'])->name('planificaciones-ejecutivas.store');
Route::delete('modulo6/planificaciones-ejecutivas/{id}', [PlanificacionEjecutivaController::class, 'destroy'])->name('planificaciones-ejecutivas.destroy');

Route::get('/modulo6/reportes/{id}', [Modulo6Controller::class, 'reporte'])->name('modulo6.reportes.show');

Route::get('modulo6/reporte/{id}/pdf', [Modulo6Controller::class, 'generarReportePdf'])->name('modulo6.reporte.pdf');

Route::put('/modulo6/proyectos/{proyecto}/finalizar', [ProyectoInversionController::class, 'finalizar'])
    ->name('proyectos.finalizar');


// Módulo 7 - Evaluación Final y Cierre
Route::get('/modulo-evaluacion-final', [Modulo7Controller::class, 'index'])
    ->middleware(['auth', 'can:ver modulo evaluación y cierre'])
    ->name('modulo7.dashboard');

Route::prefix('modulo7/evaluacion')->name('modulo7.evaluacion.')->group(function () {
    Route::get('{id}', [EvaluacionFinalController::class, 'show'])->name('show');
});

Route::get('/modulo7/evaluacion/{id}', [App\Http\Controllers\Modulo7Controller::class, 'show'])->name('modulo7.evaluacion.show');


Route::post('/modulo7/evaluacion/{id}/conclusiones', [EvaluacionFinalController::class, 'storeConclusiones'])
    ->name('evaluacion7.conclusiones.store');

Route::post('/modulo7/evaluacion/{id}/lecciones', [EvaluacionFinalController::class, 'storeLeccion'])
    ->name('evaluacion7.lecciones.store');  
    
Route::post('/modulo7/evaluacion/{id}/informe/generar', [EvaluacionFinalController::class, 'generarInforme'])->name('evaluacion7.informe.generar');
Route::post('/modulo7/evaluacion/{id}/informe/firmar', [EvaluacionFinalController::class, 'firmarInforme'])->name('evaluacion7.informe.firmar');

Route::post('/modulo7/evaluacion/{id}/cerrar', [EvaluacionFinalController::class, 'cerrarProyecto'])
    ->name('evaluacion7.cierre.store');

Route::get('/modulo-evaluacion-final/reportes', [EvaluacionFinalController::class, 'reportes'])->name('modulo7.reportes.index');

Route::get('/modulo-evaluacion-final/reporte/{id}', [EvaluacionFinalController::class, 'generarPDF'])
    ->name('modulo7.reportes.pdf');





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
