<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEmergencia;

class TipoEmergenciasController extends Controller
{
    /**
     * Muestra una lista de todos los registros de tipo de emergencia.
     * Se obtienen todos los datos del modelo y se pasan a la vista 'lista_tipo_emergencias'.
     */
    public function index()
    {
        $datos = TipoEmergencia::all();
        return view('tipo_emergencias/lista_tipo_emergencias', compact('datos'));
    }

    /**
     * Muestra el formulario para crear un nuevo tipo de emergencia.
     */
    public function create()
    {
        return view('tipo_emergencias.create');
    }

    /**
     * Almacena un nuevo registro de tipo de emergencia en la base de datos.
     * Los datos se reciben desde el formulario vía POST.
     */
    public function store(Request $request)
    {
        $tipoEmergencias = new TipoEmergencia();
        $tipoEmergencias->nombre = $request->post('nombre');
        $tipoEmergencias->save();

        return redirect()->route('tipo_emergencias.index');
    }

    /**
     * Muestra un recurso específico (actualmente no implementado).
     * Se podría usar para ver detalles de un tipo de emergencia individual.
     */
    public function show($id)
    {
        //
    }

    /**
     * Muestra el formulario para editar un tipo de emergencia (actualmente no implementado).
     * Normalmente se usaría para cargar el registro en un formulario editable.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Actualiza un registro existente de tipo de emergencia en la base de datos.
     * Recibe los nuevos datos vía POST desde el formulario de edición.
     */
    public function update(Request $request, $id)
    {
        $tipoEmergencias = TipoEmergencia::find($id);
        $tipoEmergencias->nombre = $request->post('nombre');
        $tipoEmergencias->save();

        return redirect()->route('tipo_emergencias.index');
    }

    /**
     * Elimina un tipo de emergencia de la base de datos (actualmente no implementado).
     * Idealmente se implementaría para permitir la eliminación de registros.
     */
    public function destroy($id)
    {
        //
    }
}
