<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidente;
use App\Models\TipoAccidente;
use App\Models\TipoLesion;
use App\Models\TipoRiesgo;
use App\Models\AreaUnidadProductiva; // Asegúrate de importar el modelo correcto


class AccidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Accidente::all();
        return view('/accidentes/lista_accidentes', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accidentes.create', [
            'tiposAccidentes' => TipoAccidente::all(),
            'tiposLesiones' => TipoLesion::all(),
            'tiposRiesgos' => TipoRiesgo::all(),
            'areas' => AreaUnidadProductiva::all(),
        ]);
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
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_lesion_id' => 'required|exists:tipo_lesion,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_accidente_id' => 'required|exists:tipo_accidentes,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);

        Accidente::create($request->all());

        return redirect()->route('accidentes.create')->with('success', 'Accidente registrado con éxito.');
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
    // Cargar el accidente con sus relaciones
    $accidente = Accidente::with([
        'areaUnidadProductiva', 
        'tipoLesion', 
        'tipoRiesgo', 
        'tipoAccidente'
    ])->findOrFail($id);

    // Obtener las opciones para los selects
    $areas = AreaUnidadProductiva::all();
    $lesiones = TipoLesion::all();
    $riesgos = TipoRiesgo::all();
    $tiposAccidente = TipoAccidente::all();

    // Pasar los datos a la vista
    return view('accidentes.index', compact('accidente', 'areas', 'lesiones', 'riesgos', 'tiposAccidente'));
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
        // Validación de los datos
        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_lesion_id' => 'required|exists:tipo_lesion,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_accidente_id' => 'required|exists:tipo_accidentes,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);
    
        // Obtener el accidente
        $accidente = Accidente::findOrFail($id);
    
        // Actualizar los datos del accidente
        $accidente->update([
            'fecha_hora' => $request->fecha_hora,
            'area_unidad_productiva_id' => $request->area_unidad_productiva_id,
            'tipo_lesion_id' => $request->tipo_lesion_id,
            'tipo_riesgo_id' => $request->tipo_riesgo_id,
            'tipo_accidente_id' => $request->tipo_accidente_id,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'gravedad' => $request->gravedad,
            'creado_por' => $request->creado_por,
        ]);
    
        // Redirigir con un mensaje de éxito
        return redirect()->route('accidentes.index')->with('success', 'Accidente actualizado correctamente.');
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
