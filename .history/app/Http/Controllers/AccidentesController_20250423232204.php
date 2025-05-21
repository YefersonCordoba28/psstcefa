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
        return view('', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cultivos = C::all();
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
            'area_unidad_productiva_id' => 'required|exists:areas_unidades_productivas,id',
            'tipo_lesion_id' => 'required|exists:tipos_lesiones,id',
            'tipo_riesgo_id' => 'required|exists:tipos_riesgos,id',
            'tipo_accidente_id' => 'required|exists:tipos_accidentes,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);

        Accidente::create($request->all());

        return redirect()->route('accidentes.index')->with('success', 'Accidente registrado con éxito.');
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
