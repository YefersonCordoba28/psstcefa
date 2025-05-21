<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class InseguridadesController extends Controller
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
    // Crear una nueva instancia del modelo Inseguridad
    $inseguridad = new Inseguridad();

    // Asignar los valores del formulario a los campos de la tabla
    $inseguridad->fecha_hora = $request->post('fecha_hora');
    $inseguridad->area_productiva = $request->post('area_productiva');
    $inseguridad->tipo_inseguridad = $request->post('tipo_inseguridad');
    $inseguridad->lugar_inseguridad = $request->post('lugar_inseguridad');
    $inseguridad->descripcion_inseguridad = $request->post('descripcion_inseguridad');
    $inseguridad->evidencia = $request->post('evidencia');
    $inseguridad->creado_por = $request->post('creado_por');

    // Guardar el registro en la base de datos
    $inseguridad->save();

    // Redirigir a una vista (puedes cambiarla según tu flujo de trabajo)
    return view('forminseguridades'); // Asegúrate de que esta vista exista
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
