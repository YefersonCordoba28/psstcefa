<?php

namespace App\Http\Controllers;
use App\models\RespuestaEvento;
use Illuminate\Http\Request;

use \App\Models\Accidente;
use \App\Models\Incidente;
use \App\Models\Emergencia;
use \App\Models\ActoInseguro;

class pruebasControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = RespuestaEvento::all();

        return view("pruebas.index",compact("eventos"));
    }


    public function historialReportes(Request $request)
    {

     
        use \App\Models\Accidente;
use \App\Models\Incidente;
use \App\Models\Emergencia;
use \App\Models\ActoInseguro;
        // $respuestas = RespuestaEvento::latest()->paginate(10); // 👈 aquí está el cambi

        if ($request->tabla_relacionada == "accidente") {
            $respuestas = Accidente::where('tipo_evento', 'accidente')
                ->where('id', $request->id_reporte)
                ->latest()
                ->paginate(10);
        } elseif ($request->tabla_relacionada == "incidente") {
            $respuestas = Incidente::where('tipo_evento', 'incidente')
                ->where('id', $request->id_reporte)
                ->latest()
                ->paginate(10);
        } elseif ($request->tabla_relacionada == "emergencia") {
            $respuestas = Emergencia::where('tipo_evento', 'emergencia')
                ->where('id', $request->id_reporte)
                ->latest()
                ->paginate(10);
        } elseif ($request->tabla_relacionada == "acto_inseguro") {
            $respuestas = ActoInseguro::where('tipo_evento', 'acto_inseguro')
                ->where('id', $request->id_reporte)
                ->latest()
                ->paginate(10);
        }
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
        //
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
