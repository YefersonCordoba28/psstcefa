<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidente;
use App\Models\TipoIncidente;
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
        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_incidente_id' => 'required|exists:tipo_incidentes,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'nivel_riesgo' => 'required|in:Alto,Medio,Bajo',
            'creado_por' => 'required|string',
        ]);
    
        Incidente::create($request->all());
    
        return redirect()->route('incidentes.create')->with('success', 'Incidente registrado con éxito.');
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
    $incidente = Incidente::findOrFail($id);

    $validated = $request->validate([
        'fecha_hora' => 'required|date',
        'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
        'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
        'tipo_incidente_id' => 'required|exists:tipo_incidentes,id',
        'descripcion' => 'nullable|string',
        'evidencia' => 'nullable|string',
        'nivel_riesgo' => 'required|in:Alto,Medio,Bajo',
        'creado_por' => 'required|string|max:255',
    ]);

    try {
        $incidente->update($validated);
        return redirect()->route('incidentes.index')->with('success', 'Incidente actualizado correctamente.');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => 'Error al actualizar el incidente: ' . $e->getMessage()])->withInput();
    }
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $
    }
}
