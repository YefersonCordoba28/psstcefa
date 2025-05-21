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
