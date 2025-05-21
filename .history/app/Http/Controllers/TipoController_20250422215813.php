<?php

namespace App\Http\Controllers;

use App\Models\TipoAccidente;
use App\Models\TipoLesion;
use App\Models\TipoRiesgo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    // Mostrar la vista con los formularios
    public function index()
    {
        $tipoAccidentes = TipoAccidente::all();
        $tipoLesiones = TipoLesion::all();
        $tipoRiesgos = TipoRiesgo::all();

        return view('tipos.index', compact('tipoAccidentes', 'tipoLesiones', 'tipoRiesgos'));
    }

    // Guardar un nuevo tipo de accidente
    public function storeTipoAccidente(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        TipoAccidente::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos.index')->with('success', 'Tipo de accidente creado con éxito.');
    }

    // Guardar un nuevo tipo de lesión
    public function storeTipoLesion(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        TipoLesion::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos.index')->with('success', 'Tipo de lesión creado con éxito.');
    }

    // Guardar un nuevo tipo de riesgo
    public function storeTipoRiesgo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        TipoRiesgo::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tipos.index')->with('success', 'Tipo de riesgo creado con éxito.');
    }
}