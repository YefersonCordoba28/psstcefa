<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEmergencia;

class TipoEmergenciasController extends Controller
{
     $datos = Tipo::all();
        return view('tipo_incidentes/lista_tipo_incidentes', compact('datos'));
}
