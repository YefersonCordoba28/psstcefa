<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventosController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación protegidas por el middleware centralizado
Auth::routes(['middleware' => 'role.redirect']);

// Rutas protegidas por roles
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'role:Sadmin'])->group(function () {
    Route::get('/Sadmin', function () {
        return view('Sadmin.dashboard');
    })->name('Sadmin.dashboard');
});



Route::get('/usuario', function () {
    $nombre = Auth::check() ? Auth::user()->name : 'Invitado';
    return view('usuario.dashboard', compact('nombre'));
})->middleware('auth')->name('usuario.dashboard'); // Se asigna el nombre a la ruta

Route::get('/eventos/formeventos', [EventosController::class, 'create'])->name('eventos.create');
Route::post('/eventos/store', [EventosController::class, 'store'])->name('eventos.store');
Route::get('/listac', [EventosController::class, 'index'])->name('eventos.index');
Route::put('/eventos/{id}',[EventosController::class, 'update'])->name('eventos.update');

Route::get('/Register-Admin', [RegisterAdminController::class, 'showForm'])->name('register.mayordomo.form');
Route::post('/Register-Admin', [RegisterAminController::class, 'register'])->name('register.mayordomo');