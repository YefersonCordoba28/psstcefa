<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergencia;

class EmergenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = Emergencia::all();
        return view('', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('formemergencias');
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
    $Emergencias = new Emergencia();

    // Asignar los valores del formulario a los campos de la tabla
    $Emergencias->fecha_hora = $request->post('fecha_hora');
    $Emergencias->ubicacion = $request->post('ubicacion');
    $Emergencias->descripcion_emergencia = $request->post('descripcion_emergencia');
    $Emergencias->tipo_emergencia = $request->post('tipo_emergencia');
    $Emergencias->evidencias = $request->post('evidencias');
    $Emergencias->creado_por = $request->post('creado_por');

    // Guardar el registro en la base de datos
    $Emergencias->save();

    // Redirigir a una vista (puedes cambiarla según tu flujo de trabajo)
    return view('emergencias.create'); // Asegúrate de que esta vista exista
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
