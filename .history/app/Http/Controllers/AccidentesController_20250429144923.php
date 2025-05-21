<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidente;
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
        $accidentes = Accidente::with(['areaUnidadProductiva', 'tipoLesion', 'tipoRiesgo', 'tipoAccidente'])->get();
        $areas = AreaUnidadProductiva::all();
        $tiposLesion = TipoLesion::all();
        $tiposRiesgo = TipoRiesgo::all();
        $tiposAccidente = TipoAccidente::all();
        $cargos = Cargo::all(); // Asegúrate de importar el modelo correcto
        
        return view('/accidentes/lista_accidentes', compact('accidentes', 'areas', 'tiposLesion', 'tiposRiesgo', 'tiposAccidente',"cargos"));
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

        // Cargar todas las opciones para los dropdowns
        $areas = AreaUnidadProductiva::all();
        $tiposLesion = TipoLesion::all();
        $tiposRiesgo = TipoRiesgo::all();
        $tiposAccidente = TipoAccidente::all();

        return view('accidentes.edit', compact('accidente', 'areas', 'tiposLesion', 'tiposRiesgo', 'tiposAccidente'));
    }

    // Método para actualizar el accidente
    public function update(Request $request, $id)
    {
        $accidente = Accidente::findOrFail($id);

        $validated = $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_lesion_id' => 'required|exists:tipo_lesion,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_accidente_id' => 'required|exists:tipo_accidentes,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string|max:255',
        ]);

        try {
            $accidente->update($validated);
            return redirect()->route('accidentes.index')->with('success', 'Accidente actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Error al actualizar el accidente: ' . $e->getMessage()])->withInput();
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

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
