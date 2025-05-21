<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidente;

class IncidentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Incidente::all();
        return view('', compact('datos'));
    }

    /
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formincidentes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Crear una nueva instancia del modelo Incidente
    $Incidentes = new Incidente();

    // Asignar los valores del formulario a los campos de la tabla
    $Incidentes->fecha_hora = $request->post('fecha_hora');
    $Incidentes->ubicacion = $request->post('ubicacion');
    $Incidentes->descripcion_incidente = $request->post('descripcion_incidente');
    $Incidentes->riesgo = $request->post('riesgo');
    $Incidentes->estado = $request->post('estado');
    $Incidentes->evidencias = $request->post('evidencias');
    $Incidentes->creado_por = $request->post('creado_por');

    // Guardar el registro en la base de datos
    $Incidentes->save();

    // Redirigir a una vista (puedes cambiarla según tu flujo de trabajo)
    return view('formincidentes'); // Asegúrate de que esta vista exista
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
