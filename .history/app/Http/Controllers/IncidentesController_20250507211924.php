<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidente;

use App\Models\TipoRiesgo;
use App\Models\AreaUnidadProductiva; // Asegúrate de importar el modelo correcto

class IncidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidentes = Incidente::with(['areaUnidadProductiva', 'tipoRiesgo', 'tipoIncidente'])->get();
        $areas = AreaUnidadProductiva::all();
        $tiposRiesgo = TipoRiesgo::all();
        $tiposIncidente = TipoIncidente::all();

        return view('/incidentes/lista_incidentes', compact('incidentes', 'areas', 'tiposRiesgo', 'tiposIncidente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidentes.create', [
            'tiposIncidentes' => TipoIncidente::all(),
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
        return $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_incidente_id' => 'required|exists:tipo_incidente,id',
            'descripcion' => 'required|string|max:255',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'nivel_riesgo' => 'required|string|max:255',
        ]);
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

        $incidente = Incidente::with([
            'areaUnidadProductiva',
            'tipoLesion',
            'tipoRiesgo',
            'tipoIncidente'
        ])->findOrFail($id);

        $incidente = Incidente::findOrFail($id);
        $tiposIncidentes = TipoIncidente::all();
        $tiposRiesgos = TipoRiesgo::all();
        $areas = AreaUnidadProductiva::all();

        return view('incidentes.edit', compact('incidente', 'tiposIncidentes', 'tiposRiesgos', 'areas'));
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
