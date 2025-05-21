<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RespuestaEvento;

class RespuestaEventosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{



    $respuestas = RespuestaEvento::latest()->paginate(10); // 👈 aquí está el cambio
    
    
  // dd($respuestas->toArray()); // 👈 para ver la estructura de datos
    

    foreach ($respuestas as $respuesta) {
        if($respuesta->tipo_evento == 'accidente') {
            $respuesta->evento = \App\Models\Accidente::find($respuesta->evento_id);
        } elseif($respuesta->tipo_evento == 'incidente') {
            $respuesta->evento = \App\Models\Incidente::find($respuesta->evento_id);
        } elseif($respuesta->tipo_evento == 'emergencia') {
            $respuesta->evento = \App\Models\Emergencia::find($respuesta->evento_id);
        } elseif($respuesta->tipo_evento == 'acto_inseguro') {
            $respuesta->evento = \App\Models\ActoInseguro::find($respuesta->evento_id);
        }
    }
    
    return view('respuestas.lista_respuestas', compact('respuestas'));
}


public function historialReportes


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function create()
{
    $accidentes = \App\Models\Accidente::all();
    $incidentes = \App\Models\Incidente::all();
    $emergencias = \App\Models\Emergencia::all();
    $actos = \App\Models\ActoInseguro::all();

    // Nuevos datos para mapeo de IDs a nombres
    $areasUnidades = \App\Models\AreaUnidadProductiva::all();
    $tiposLesiones = \App\Models\TipoLesion::all();
    $tiposRiesgos = \App\Models\TipoRiesgo::all();
    $tiposAccidentes = \App\Models\TipoAccidente::all();
    $tipoIncidentes = \App\Models\TipoIncidente::all();
    $tipoEmergencias = \App\Models\TipoEmergencia::all();
    $tiposActoInseguro = \App\Models\TipoActoInseguro::all();
    
    return view('respuestas.create', compact(
        'accidentes', 'incidentes', 'emergencias', 'actos',
        'areasUnidades', 'tiposLesiones', 'tiposRiesgos', 'tiposAccidentes',
        'tipoIncidentes', 'tipoEmergencias', 'tiposActoInseguro'
    ));
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
        'evento_id' => 'required|integer',
        'tipo_evento' => 'required|in:accidente,incidente,emergencia,acto_inseguro',
        'respuesta' => 'nullable|string',
        'acciones_tomadas' => 'nullable|string',
        'fecha_respuesta' => 'required|date',
        'respondido_por' => 'nullable|string|max:255',
    ]);

    RespuestaEvento::create([
        'evento_id' => $request->evento_id,
        'tipo_evento' => $request->tipo_evento,
        'respuesta' => $request->respuesta,
        'acciones_tomadas' => $request->acciones_tomadas,
        'fecha_respuesta' => $request->fecha_respuesta,
        'respondido_por' => $request->respondido_por,
    ]);

    return redirect()->route('respuestas.index')->with('success', 'Respuesta registrada correctamente.');
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
