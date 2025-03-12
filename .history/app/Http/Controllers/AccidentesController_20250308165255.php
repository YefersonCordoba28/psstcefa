<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accidente;


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
        return view('formaccidentes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Crear una nueva instancia del modelo Accidente
    $Accidentes = new Accidente();

    // Asignar los valores del formulario a los campos de la tabla
    $Accidentes->fecha_hora = $request->post('fecha_hora');
    $Accidentes->ubicacion = $request->post('ubicacion');
    $Accidentes->descripcion_accidente = $request->post('descripcion_accidente');
    $Accidentes->personas_involucradas = $request->post('personas_involucradas');
    $Accidentes->gravedad = $request->post('gravedad');
    $Accidentes->evidencias = $request->post('evidencias');
    $Accidentes->creado_por = $request->post('creado_por');

    // Guardar el registro en la base de datos
    $Accidentes->save();

    // Redirigir a una vista (puedes cambiarla según tu flujo de trabajo)
    return view('formaccidentes'); // Asegúrate de que esta vista exista
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
