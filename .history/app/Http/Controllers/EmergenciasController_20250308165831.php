<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmergenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Crear una nueva instancia del modelo Emergencia
    $Emergencia = new Emergencia();

    // Asignar los valores del formulario a los campos de la tabla
    $Emergencia->fecha_hora = $request->post('fecha_hora');
    $Emergencia->ubicacion = $request->post('ubicacion');
    $Emergencia->descripcion_emergencia = $request->post('descripcion_emergencia');
    $Emergencia->tipo_emergencia = $request->post('tipo_emergencia');
    $Emergencia->evidencias = $request->post('evidencias');
    $Emergencia->creado_por = $request->post('creado_por');

    // Guardar el registro en la base de datos
    $Emergencia->save();

    // Redirigir a una vista (puedes cambiarla según tu flujo de trabajo)
    return view('formemergencias'); // Asegúrate de que esta vista exista
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
