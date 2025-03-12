<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::all(); // Obtiene todos los eventos de la base de datos
        return view('prueba.prueba', compact('eventos'));
    
    }

    public function upload(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'ubicación' => 'required|string|max:255',
            'tipo_evento' => 'required|in:Accidente,Incidente,Emergencia',
            'descripción_evento' => 'required',
            'evidencias' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'creado_por' => 'required|string|max:255',
        ]);
    
        // Crear una nueva instancia del modelo Evento
        $evento = new Evento();
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->ubicación = $request->ubicación;
        $evento->tipo_evento = $request->tipo_evento;
        $evento->descripción_evento = $request->descripción_evento;
        $evento->personas_involucradas = $request->personas_involucradas;
        $evento->testigos = $request->testigos;
        $evento->creado_por = $request->creado_por;
    
        // Manejo de la imagen
        if ($request->hasFile('evidencias')) {
            $imagePath = $request->file('evidencias')->store('public/evidencias');
            $evento->evidencias = str_replace('public/', 'storage/', $imagePath);
        }
    
        // Guardar el evento en la base de datos
        $evento->save();
    
        return back()->with('success', 'Evento registrado correctamente.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
