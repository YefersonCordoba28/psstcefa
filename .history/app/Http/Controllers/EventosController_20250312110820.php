<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = evento::all();
        return view('listac', compact('datos'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formeventos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */

     
    public function store(Request $request)
    {
        $Evento = new Evento();
        $Evento->fecha = $request->post('fecha');
        $Evento->hora = $request->post('hora');
        $Evento->ubicación = $request->post('ubicación');
        $Evento->tipo_evento = $request->post('tipo_evento');
        $Evento->descripción_evento = $request->post('descripción_evento');
        $Evento->personas_involucradas = $request->post('personas_involucradas');
        $Evento->testigos = $request->post('testigos');
        $Evento->evidencias = $request->post('evidencias');
        $Evento->creado_por = $request->post('creado_por');
        $Evento->save();

        return view('formeventos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $eventos
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $eventos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $eventos
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $eventos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $eventos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $eventos)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $eventos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $eventos)
    {
        //
    }
}
