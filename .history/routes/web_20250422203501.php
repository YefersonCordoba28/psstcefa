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

Route::get('/eventos/formeventos', [EventosController::class, 'create'])->name('eventos.create');
Route::post('/eventos/store', [EventosController::class, 'store'])->name('eventos.store');
Route::get('/listac', [EventosController::class, 'index'])->name('eventos.index');
Route::put('/eventos/{id}',[EventosController::class, 'update'])->name('eventos.update');
Route::post('/upload', [Image1Controller::class, 'upload'])->name('image.upload');

Route::get('/Register-Admin', [RegisterAdminController::class, 'showForm'])->name('register.admin.form');
Route::post('/Register-Admin', [RegisterAdminController::class, 'register'])->name('register.admin');

Route::get('/Register-Instructor', [RegisterInstructorController::class, 'showForm'])->name('register.instructor.form');
Route::post('/Register-Instructor', [RegisterInstructorController::class, 'register'])->name('register.instructor');

Route::get('/accidentes/formaccidentes', [AccidentesController::class, 'create'])->name('accidentes.create');
Route::post('/accidentes/store', [AccidentesController::class, 'store'])->name('accidentes.store');
Route::get('/', [AccidentesController::class, 'index'])->name('accidentes.index');

Route::get('/incidentes/formincidentes', [IncidentesController::class, 'create'])->name('incidentes.create');
Route::post('/incidentes', [IncidentesController::class, 'store'])->name('incidentes.store');
Route::get('/', [IncidentesController::class, 'index'])->name('incidentes.index');

Route::get('/emergencias/formemergencias', [EmergenciasController::class, 'create'])->name('emergencias.create');
Route::post('/incidentes/store', [EmergenciasController::class, 'store'])->name('emergencias.store');
Route::get('/', [EmergenciasController::class, 'index'])->name('emergencias.index');

Route::get('/inseguridades/forminseguridades', [InseguridadesController::class, 'create'])->name('inseguridades.create');
Route::post('/inseguridades/store', [InseguridadesController::class, 'store'])->name('inseguridades.store');
Route::get('/', [InseguridadesController::class, 'index'])->name('inseguridades.index');

