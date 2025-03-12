<?php

namespace App\Http\Controllers;

use App\Models\Eventos;
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
        $datos = eventos::all();
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
    public function store(Request $request)
{
    $evento = new Evento();
    $evento->fecha = $request->fecha;
    $evento->hora = $request->hora;
    $evento->ubicación = $request->ubicación;
    $evento->tipo_evento = $request->tipo_evento;
    $evento->descripción_evento = $request->descripción_evento;
    $evento->personas_involucradas = $request->personas_involucradas;
    $evento->testigos = $request->testigos;
    $evento->creado_por = auth()->user()->name;

    if ($request->hasFile('evidencias')) {
        $path = $request->file('evidencias')->store('public/evidencias');
        $evento->evidencias = $path; // Guarda la ruta en la base de datos
    }

        return view('formeventos');
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function show(Eventos $eventos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function edit(Eventos $eventos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eventos $eventos)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eventos $eventos)
    {
        //
    }
}
