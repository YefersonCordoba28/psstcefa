<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergencia;
use App\Models\AreaUnidadProductiva;
use App\Models\TipoEmergencia;
use App\Models\TipoRiesgo;

class EmergenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $emergencias = Emergencia::with(['areaUnidadProductiva', 'tipoEmergencia', 'tipoRiesgo'])->get();
       $areas = AreaUnidadProductiva::all();
       $tiposEmergencia = TipoEmergencia::all();
       $tiposRiesgo = TipoRiesgo::all();

    return view('emergencias.lista_emergencias', compact('emergencias', 'areas', 'tiposEmergencia', 'tiposRiesgo', 'cargos')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emergencias.create', [
            'tiposEmergencias' => TipoEmergencia::all(),
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
            'tipo_emergencia_id' => 'required|exists:tipo_emergencias,id',
            'descripcion' => 'required|string|max:255',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'nivel_riesgo' => 'required|string|max:50',
        ]);

        $emergencia = new Emergencia();
        $emergencia->fecha_hora = $request->post('fecha_hora');
        $emergencia->area_unidad_productiva_id = $request->post('area_unidad_productiva_id');
        $emergencia->tipo_riesgo_id = $request->post('tipo_riesgo_id');
        $emergencia->tipo_emergencia_id = $request->post('tipo_emergencia_id');
        $emergencia->descripcion = $request->post('descripcion');
        if ($request->hasFile('evidencia')) {
            $file = $request->file('evidencia');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('evidencias'), $filename);
            $emergencia->evidencia = $filename;
        }
        $emergencia->nivel_riesgo = $request->post('nivel_riesgo');
        // Aquí puedes agregar el campo creado_por si es necesario
        // $emergencia->creado_por = auth()->user()->id;
        $emergencia->save();

        return redirect()->route('emergencias.index');
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
