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