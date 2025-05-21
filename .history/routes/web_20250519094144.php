<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Ruta principal
Route::get('/', function () {
    return view('welcome');
});


// Rutas de autenticación protegidas por el middleware centralizado
Auth::routes(['middleware' => 'role.redirect']);

// Rutas protegidas por roles


Route::get('/admin', function () {
    $nombre = Auth::check() ? Auth::user()->name : 'Invitado';
    return view('admin.dashboard', compact('nombre'));
})->middleware('auth')->name('admin.dashboard'); // Se asigna el nombre a la ruta

Route::get('/instructor', function () {
    $nombre = Auth::check() ? Auth::user()->name : 'Invitado';
    return view('instructor.dashboard', compact('nombre'));
})->middleware('auth')->name('instructor.dashboard'); // Se asigna el nombre a la ruta

use App\Http\Controllers\TipoAccidentesController;

Route::get('/tipo_accidentes/create', [TipoAccidentesController::class, 'create'])->name('tipo_accidentes.create');
Route::post('/tipo_accidentes/store', [TipoAccidentesController::class, 'store'])->name('tipo_accidentes.store');
Route::get('/tipo_accidentes/lista_tipos',[TipoAccidentesController::class, 'index'])->name('tipo_accidentes.index');
Route::delete('/tipo_accidentes/{id}',[TipoAccidentesController::class, 'destroy'])->name('tipo_accidentes.destroy');
Route::put('/tipo_accidentes/{id}',[TipoAccidentesController::class, 'update'])->name('tipo_accidentes.update');

use App\Http\Controllers\AreaunidadproductivasController;

Route::get('/area_unidad_productivas/create', [AreaunidadproductivasController::class, 'create'])->name('area_unidad_productivas.create');
Route::post('/area_unidad_productivas/store', [AreaunidadproductivasController::class, 'store'])->name('area_unidad_productivas.store');
Route::get('/area_unidad_productivas/lista_areas_unidades',[AreaunidadproductivasController::class, 'index'])->name('area_unidad_productivas.index');
Route::delete('/area_unidad_productivas/{id}',[AreaunidadproductivasController::class, 'destroy'])->name('area_unidad_productivas.destroy');
Route::put('/area_unidad_productivas/{id}',[AreaunidadproductivasController::class, 'update'])->name('area_unidad_productivas.update');

use App\Http\Controllers\TipoLesionesController;

Route::get('/tipo_lesiones/create', [TipoLesionesController::class, 'create'])->name('tipo_lesiones.create');
Route::post('/tipo_lesiones/store', [TipoLesionesController::class, 'store'])->name('tipo_lesiones.store');
Route::get('/tipo_lesiones/lista_tipos_lesiones',[TipoLesionesController::class, 'index'])->name('tipo_lesiones.index');
Route::delete('/tipo_lesiones/{id}',[TipoLesionesController::class, 'destroy'])->name('tipo_lesiones.destroy');
Route::put('/tipo_lesiones/{id}',[TipoLesionesController::class, 'update'])->name('tipo_lesiones.update');

use App\Http\Controllers\TipoRiesgosController;

Route::get('/tipo_riesgos/create', [TipoRiesgosController::class, 'create'])->name('tipo_riesgos.create');
Route::post('/tipo_riesgos/store', [TipoRiesgosController::class, 'store'])->name('tipo_riesgo.store');
Route::get('/tipo_riesgos/lista_tipos_riesgos',[TipoRiesgosController::class, 'index'])->name('tipo_riesgo.index');
Route::delete('/tipo_riesgos/{id}',[TipoRiesgosController::class, 'destroy'])->name('tipo_riesgo.destroy');
Route::put('/tipo_riesgos/{id}',[TipoRiesgosController::class, 'update'])->name('tipo_riesgo.update');

use App\Http\Controllers\AccidentesController;
Route::get('/accidentes/create', [AccidentesController::class, 'create'])->name('accidentes.create');
Route::post('/accidentes/store', [AccidentesController::class, 'store'])->name('accidentes.store');
Route::get('/accidentes/lista_accidentes',[AccidentesController::class, 'index'])->name('accidentes.index');
Route::delete('/accidentes/{id}',[AccidentesController::class, 'destroy'])->name('accidentes.destroy');
Route::put('/accidentes/{id}',[AccidentesController::class, 'update'])->name('accidentes.update');

use App\Http\Controllers\CargosController;
Route::get('/cargos/create', [CargosController::class, 'create'])->name('cargos.create');
Route::post('/cargos/store', [CargosController::class, 'store'])->name('cargos.store');

use App\Http\Controllers\PersonasInvolucradasController;

Route::get('/personas_involucradas/create', [PersonasInvolucradasController::class, 'create'])->name('personas_involucradas.create');
Route::post('/personas_involucradas/store', [PersonasInvolucradasController::class, 'store'])->name('personas_involucradas.store');
Route::get('/personas_involucradas/lista_personas',[PersonasInvolucradasController::class, 'index'])->name('personas_involucradas.index');
Route::delete('/personas_involucradas/{id}',[PersonasInvolucradasController::class, 'destroy'])->name('personas_involucradas.destroy');


use App\Http\Controllers\TipoIncidentesController;
Route::get('/tipo_incidentes/create', [TipoIncidentesController::class, 'create'])->name('tipo_incidentes.create');
Route::post('/tipo_incidentes/store', [TipoIncidentesController::class, 'store'])->name('tipo_incidentes.store');
Route::get('/tipo_incidentes/lista_tipos_incidentes',[TipoIncidentesController::class, 'index'])->name('tipo_incidentes.index');
Route::put('/tipo_incidentes/{id}',[TipoIncidentesController::class, 'update'])->name('tipo_incidentes.update');

use App\Http\Controllers\IncidentesController;
Route::get('/incidentes/create', [IncidentesController::class, 'create'])->name('incidentes.create');
Route::post('/incidentes/store', [IncidentesController::class, 'store'])->name('incidentes.store');
Route::get('/incidentes/lista_incidentes',[IncidentesController::class, 'index'])->name('incidentes.index');
Route::put('/incidentes/{id}',[IncidentesController::class, 'update'])->name('incidentes.update');
Route::delete('/incidentes/{id}',[IncidentesController::class, 'destroy'])->name('incidentes.destroy');

use App\Http\Controllers\TipoEmergenciasController;
Route::get('/tipo_emergencias/create', [TipoEmergenciasController::class, 'create'])->name('tipo_emergencias.create');
Route::post('/tipo_emergencias/store', [TipoEmergenciasController::class, 'store'])->name('tipo_emergencias.store');
Route::get('/tipo_emergencias/lista_tipos_emergencias',[TipoEmergenciasController::class, 'index'])->name('tipo_emergencias.index');
Route::put('/tipo_emergencias/{id}',[TipoEmergenciasController::class, 'update'])->name('tipo_emergencias.update');
Route::delete('/tipo_emergencias/{id}',[TipoEmergenciasController::class, 'destroy'])->name('tipo_emergencias.destroy');

use App\Http\Controllers\TiposActosInsegurosController;
Route::get('/tipo_actos_inseguros/create', [TiposActosInsegurosController::class, 'create'])->name('tipo_actos_inseguros.create');
Route::post('/tipo_actos_inseguros/store', [TiposActosInsegurosController::class, 'store'])->name('tipo_actos_inseguros.store');
Route::get('/tipo_actos_inseguros/lista_tipos_actos',[TiposActosInsegurosController::class, 'index'])->name('tipo_actos_inseguros.index');
Route::put('/tipo_actos_inseguros/{id}',[TiposActosInsegurosController::class, 'update'])->name('tipo_actos_inseguros.update');
Route::delete('/tipo_actos_inseguros/{id}',[TiposActosInsegurosController::class, 'destroy'])->name('tipo_actos_inseguros.destroy');

use App\Http\Controllers\EmergenciasController;
Route::get('/emergencias/create', [EmergenciasController::class, 'create'])->name('emergencias.create');
Route::post('/emergencias/store', [EmergenciasController::class, 'store'])->name('emergencias.store');
Route::get('/emergencias/lista_emergencias',[EmergenciasController::class, 'index'])->name('emergencias.index');
Route::put('/emergencias/{id}',[EmergenciasController::class, 'update'])->name('emergencias.update');
Route::delete('/emergencias/{id}',[EmergenciasController::class, 'destroy'])->name('emergencias.destroy');

use App\Http\Controllers\A_insegurosController;
Route::get('/actos_inseguros/create', [A_insegurosController::class, 'create'])->name('actos_inseguros.create');
Route::post('/actos_inseguros/store', [A_insegurosController::class, 'store'])->name('actos_inseguros.store');
Route::get('/actos_inseguros/lista_actos_inseguros',[A_insegurosController::class, 'index'])->name('actos_inseguros.index');
Route::put('/actos_inseguros/{id}',[A_insegurosController::class, 'update'])->name('actos_inseguros.update');
Route::delete('/actos_inseguros/{id}',[A_insegurosController::class, 'destroy'])->name('actos_inseguros.destroy');

use App\Http\Controllers\RespuestaEventosController;

// RUTA PARA VER TODAS LAS RESPUESTAS REGISTRADAS
Route::get('/respuestas', [RespuestaEventosController::class, 'index'])->name('respuestas.index');

// RUTA PARA MOSTRAR EL FORMULARIO DE REGISTRO DE UNA RESPUESTA NUEVA
Route::get('/respuestas/create', [RespuestaEventosController::class, 'create'])->name('respuestas.create');

// RUTA PARA GUARDAR UNA NUEVA RESPUESTA
Route::post('/respuestas', [RespuestaEventosController::class, 'store'])->name('respuestas.store');


// rutas para hacer pruebas

