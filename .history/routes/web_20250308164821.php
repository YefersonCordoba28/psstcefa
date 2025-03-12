<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\AccidentesController;
use App\Http\Controllers\IncidentesController;
use App\Http\Controllers\Auth\RegisterAdminController;
use App\Http\Controllers\Auth\RegisterFuncionarioController;
use App\Http\Controllers\Auth\RegisterInstructorController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\Image1Controller;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});


Route::get('/form', [ImageController::class, 'index'])->name('image.form');
Route::post('/upload', [ImageController::class, 'upload'])->name('image.upload');

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

Route::get('/incidentes/formincidentes', [IncidentesController::class, 'create'])->name('accidentes.create');
Route::post('/accidentes/store', [IncidentesController::class, 'store'])->name('accidentes.store');
Route::get('/', [IncidentesController::class, 'index'])->name('accidentes.index');