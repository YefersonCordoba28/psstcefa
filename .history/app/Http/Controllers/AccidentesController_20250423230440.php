<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidente;


class AccidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Accidente::all();
        return view('listaAccidentes', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accidente.create', [
            'tiposAccidentes' => TipoAccidente::all(),
            'tiposLesiones' => TipoLesion::all(),
            'tiposRiesgos' => TipoRiesgo::all(),
            'areas' => AreaUnidadProductiva::all(),
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo_accidente_id' => 'required|exists:tipos_accidentes,id',
            'fecha_hora' => 'required|date',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);
    
        Accidente::create($request->all());
    
        return redirect()->route('accidentes.create')->with('success', 'Accidente registrado con éxito.');
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
