<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cargo;
use App\Models\Accidente;
use App\Models\PersonaInvolucrada;


class PersonasInvolucradasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = PersonaInvolucrada::all(); 
       
        return view('personas_invol', compact('datos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    //     'cargos' => Cargo::all(),
    //     'accidentes' => Accidente::all(),
    // ]

        $cargos = Cargo::all();
        $accidentes = Accidente::all();

        // dd($cargos, $accidentes);
        return view('personas_involucradas.create', compact('cargos', 'accidentes')); 
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validated = $request->validate([
            'accidente_id' => 'nullable|exists:accidentes,id',
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'cargo_id'     => 'nullable|exists:cargos,id',
        ]);
    
        // Crear persona involucrada
        PersonaInvolucrada::create($validated);
    
        // Redireccionar con mensaje de éxito
        return redirect()->back()->with('success', 'Persona involucrada registrada correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
