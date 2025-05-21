<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergencia;
use App\Models\AreaUnidadProductiva;
use App\Models\TipoEmergencia;
use App\Models\TipoRiesgo;

class EmergenciasController extends Controller
{
    // Mostrar el formulario
    public function create()
    {
        // Obtener los datos necesarios para las relaciones foráneas
        $areas = AreaUnidadProductiva::all();
        $tiposEmergencia = TipoEmergencia::all();
        $tiposRiesgo = TipoRiesgo::all();

        return view('emergencias.create', compact('areas', 'tiposEmergencia', 'tiposRiesgo'));
    }

    // Procesar el formulario y guardar los datos en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_emergencia_id' => 'required|exists:tipo_emergencias,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);

        // Crear la emergencia en la base de datos
        Emergencia::create([
            'fecha_hora' => $request->fecha_hora,
            'area_unidad_productiva_id' => $request->area_unidad_productiva_id,
            'tipo_emergencia_id' => $request->tipo_emergencia_id,
            'tipo_riesgo_id' => $request->tipo_riesgo_id,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'gravedad' => $request->gravedad,
            'creado_por' => $request->creado_por,
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('emergencias.create')->with('success', 'Emergencia registrada correctamente.');
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
