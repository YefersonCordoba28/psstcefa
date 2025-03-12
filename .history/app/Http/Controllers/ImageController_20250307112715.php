<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view("prueba.prueba");
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

        // Manejo de la imagen
        $imagePath = null;
        if ($request->hasFile('evidencias')) {
            $imagePath = $request->file('evidencias')->store('public/evidencias');
            $imagePath = str_replace('public/', 'storage/', $imagePath); // Ajustar la ruta para el acceso web
        }

        // Guardar el evento en la base de datos
        Evento::create([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'ubicación' => $request->ubicación,
            'tipo_evento' => $request->tipo_evento,
            'descripción_evento' => $request->descripción_evento,
            'personas_involucradas' => $request->personas_involucradas,
            'testigos' => $request->testigos,
            'evidencias' => $imagePath,
            'creado_por' => $request->creado_por,
        ]);

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
