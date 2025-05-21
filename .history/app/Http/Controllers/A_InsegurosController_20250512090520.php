<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActoInseguro;
use App\Models\AreaUnidadProductiva; 
use App\Models\TipoActoInseguro;
use App\Models\TipoRiesgo;  

class A_InsegurosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inseguros = ActoInseguro::with(['areaUnidadProductiva', 'tipoActoInseguro', 'tipoRiesgo'])->get();
        $areas = AreaUnidadProductiva::all();
        $tiposActoInseguro = TipoActoInseguro::all();
        $tiposRiesgo = TipoRiesgo::all();
        return view('/actos_inseguros/lista_actos_inseguros', compact('inseguros', 'areas', 'tiposActoInseguro', 'tiposRiesgo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('actos_inseguros.create', [  
            'tiposActoInseguros' => TipoActoInseguro::all(),
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
            'tipo_acto_inseguro_id' => 'required|exists:tipo_acto_inseguros,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'descripcion' => 'nullable|string|max:255',
            'evidencia' => 'nullable|string|max:255',
            'gravedad' => 'nullable|in:leve,moderada,grave',
        ]);

        ActoInseguro::create($request->all());

        return redirect()->route('actos_inseguros.index')->with('success', 'Acto inseguro creado exitosamente.');
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
        $inseguros = ActoInseguro::with([
            'areaUnidadProductiva',
            'tipoActoInseguro',
             'tipoRiesgo'
             ])->findOrFail($id);

        $areas = AreaUnidadProductiva::all();
        $tiposActoInseguro = TipoActoInseguro::all();
        $tiposRiesgo = TipoRiesgo::all();
        return view('actos_inseguros.edit', compact('inseguros', 'areas', 'tiposActoInseguro', 'tiposRiesgo'));

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
        $inseguros = ActoInseguro::findOrFail($id);

        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_acto_inseguro_id' => 'required|exists:tipo_acto_inseguros,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'descripcion' => 'nullable|string|max:255',
            'evidencia' => 'nullable|string|max:255',
            'gravedad' => 'nullable|in:leve,moderada,grave',
        ]);

        
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
