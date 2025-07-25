<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoLesion;

class TipoLesionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = TipoLesion::all();
        return view('tipo_lesiones/lista_tipo_lesiones', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_lesiones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoLesiones = new TipoLesion();
        $tipoLesiones->nombre = $request->post('nombre');
        $tipoLesiones->save();

        return redirect()->route('tipo_lesiones.index');
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
        $tipoLesiones = TipoLesion::findOrFail($id);
        $tipoLesiones->nombre = $request->input('nombre');
        $tipoLesiones->save();
    
        return redirect()->route('tipo_lesiones.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoLesiones = TipoLesion::findOrFail($id);
        $tipoLesiones-> delete();

        return redirect()->route('tipo_lesiones.index');
    }
}
