<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEmergencia;
use App\Models\TipoRiesgo;
use App\Models\AreaUnidadProductiva;
use App\Models\Emergencia;


class EmergenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emergencias = Emergencia::with(['areaUnidadProductiva', 'tipoEmergencia'])->get();
        $areas = AreaUnidadProductiva::all();
        $tiposEmergencia = TipoEmergencia::all();

        return view('emergencias.lista_emergencias', compact('emergencias', 'areas', 'tiposEmergencia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emergencias.create', [
            'tiposEmergencia' => TipoEmergencia::all(),
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
        //
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
