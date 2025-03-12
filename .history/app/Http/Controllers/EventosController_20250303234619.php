<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use Illuminate\Support\Facades\Storage;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Eventos::all();
        return view('eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eventos.create');
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
            'fecha' => 'required|date',
            'hora' => 'required',
            'ubication' => 'required|string',
            'tips_event' => 'required|in:accidente,incidente,Energencia',
            'description_events' => 'required|string',
            'persons_involucradas' => 'nullable|string',
            'testigos' => 'nullable|string',
            'evidencias' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'creado_por' => 'required|string',
        ]);

        $evento = new Eventos();
        $evento->fecha = $request->fecha;
        $evento->hora = $request->hora;
        $evento->ubication = $request->ubication;
        $evento->tips_event = $request->tips_event;
        $evento->description_events = $request->description_events;
        $evento->persons_involucradas = $request->persons_involucradas;
        $evento->testigos = $request->testigos;
        $evento->creado_por = $request->creado_por;

        if ($request->hasFile('evidencias')) {
            $image = $request->file('evidencias');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $evento->evidencias = $imageName;
        }

        $evento->save();

        return redirect()->route('eventos.index')->with('success', 'Evento creado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function show(Eventos $eventos)
    {
        return view('eventos.show', compact('eventos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function edit(Eventos $eventos)
    {
        return view('eventos.edit', compact('eventos'));
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
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'ubication' => 'required|string',
            'tips_event' => 'required|in:accidente,incidente,Energencia',
            'description_events' => 'required|string',
            'persons_involucradas' => 'nullable|string',
            'testigos' => 'nullable|string',
            'evidencias' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'creado_por' => 'required|string',
        ]);

        $eventos->fecha = $request->fecha;
        $eventos->hora = $request->hora;
        $eventos->ubication = $request->ubication;
        $eventos->tips_event = $request->tips_event;
        $eventos->description_events = $request->description_events;
        $eventos->persons_involucradas = $request->persons_involucradas;
        $eventos->testigos = $request->testigos;
        $eventos->creado_por = $request->creado_por;

        if ($request->hasFile('evidencias')) {
            // Eliminar la imagen anterior si existe
            if ($eventos->evidencias && file_exists(public_path('images/' . $eventos->evidencias))) {
                unlink(public_path('images/' . $eventos->evidencias));
            }

            $image = $request->file('evidencias');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $eventos->evidencias = $imageName;
        }

        $eventos->save();

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eventos  $eventos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Eventos $eventos)
    {
        if ($eventos->evidencias && file_exists(public_path('images/' . $eventos->evidencias))) {
            unlink(public_path('images/' . $eventos->evidencias));
        }

        $eventos->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento eliminado correctamente.');
    }
}