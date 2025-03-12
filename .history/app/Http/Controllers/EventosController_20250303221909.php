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
    {
         $request->validate([
        'fecha' => 'required|date',
        'hora' => 'required',
        'ubicación' => 'required|string',
        'tipo_evento' => 'required|string',
        'descripción_evento' => 'required|string',
        'personas_involucradas' => 'nullable|string',
        'testigos' => 'nullable|string',
        'evidencias' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
        'creado_por' => 'required|string',
    ]);

    // Crear un nuevo evento
    $Evento = new Eventos();
    $Evento->fecha = $request->fecha;
    $Evento->hora = $request->hora;
    $Evento->ubicación = $request->ubicación;
    $Evento->tipo_evento = $request->tipo_evento;
    $Evento->descripción_evento = $request->descripción_evento;
    $Evento->personas_involucradas = $request->personas_involucradas;
    $Evento->testigos = $request->testigos;
    $Evento->creado_por = $request->creado_por;

    // Procesar la imagen si se envió
    if ($request->hasFile('evidencias')) {
        $imagen = $request->file('evidencias');
        $nombreImagen = time() . '.' . $imagen->getClientOriginalExtension();
        $ruta = $imagen->storeAs('public/evidencias', $nombreImagen); // Guarda en storage/app/public/evidencias
        $Evento->evidencias = 'storage/evidencias/' . $nombreImagen; // Guarda la ruta en la BD
    }


        return view('formeventos');
    }

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
