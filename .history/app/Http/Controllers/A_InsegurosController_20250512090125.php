<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActoInseguro;
use App\Models\AreaUnidadProductiva; 
use App\Models\TipoActoInseguro;
use App\Models\TipoRiesgo;  

class A_InsegurosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inseguros = ActoInseguro::with(['areaUnidadProductiva', 'tipoActoInseguro', 'tipoRiesgo'])->get();
        $areas = AreaUnidadProductiva::all();
        $tiposActoInseguro = TipoActoInseguro::all();
        $tiposRiesgo = TipoRiesgo::all();
        return view('/actos_inseguros/lista_actos_inseguros', compact('inseguros', 'areas', 'tiposActoInseguro', 'tiposRiesgo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
