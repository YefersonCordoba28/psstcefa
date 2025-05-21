<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TipoController;


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

Route::get('/tipos', [TipoController::class, 'index'])->name('tipos.index');
Route::match(['get', 'post'], '/tipos/tipo-accidente', [TipoController::class, '']);
Route::post('/tipos/tipo-lesion', [TipoController::class, 'storeTipoLesion'])->name('tipos.storeTipoLesion');
Route::post('/tipos/tipo-riesgo', [TipoController::class, 'storeTipoRiesgo'])->name('tipos.storeTipoRiesgo');
