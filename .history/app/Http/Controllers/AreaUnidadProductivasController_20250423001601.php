<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreaUnidadProductiva; // Asegúrate de importar el modelo correcto

class AreaUnidadProductivasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = AreaUnidadProductiva::all();
        return view('', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('area_unidad_productivas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $areaUnidadProductiva = new AreaUnidadProductiva();
        $areaUnidadProductiva->nombre = $request->post('nombre');
        $areaUnidadProductiva->descripcion = $request->post('descripcion');
        $areaUnidadProductiva->save();

        return redirect()->route('area_unidad_productivas.create');
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
        $areaUnidadProductiva = AreaUnidadProductiva::findOrFail($id);
        $areaUnidadProductiva->nombre = $request->input('nombre');
        $areaUnidadProductiva->descripcion = $request->input('descripcion');
        $areaUnidadProductiva->save();

        return redirect()->route('area_unidad_productivas.create');
   

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
