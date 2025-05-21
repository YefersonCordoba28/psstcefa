<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergencia;
use App\Models\AreaUnidadProductiva;
use App\Models\TipoEmergencia;
use App\Models\TipoRiesgo;
use Illuminate\Support\Facades\Storage;

class EmergenciasController extends Controller
{
    /**
     * Mostrar listado de emergencias.
     */
    public function index()
    {
        $emergencias = Emergencia::with(['areaUnidadProductiva', 'tipoEmergencia', 'tipoRiesgo'])->get();
        $areas = AreaUnidadProductiva::all();
        $tiposEmergencia = TipoEmergencia::all();
        $tiposRiesgo = TipoRiesgo::all();

        return view('emergencias.lista_emergencias', compact('emergencias', 'areas', 'tiposEmergencia', 'tiposRiesgo'));
    }

    /**
     * Mostrar formulario para crear una nueva emergencia.
     */
    public function create()
    {
        return view('emergencias.create', [
            'tiposEmergencias' => TipoEmergencia::all(),
            'tiposRiesgos' => TipoRiesgo::all(),
            'areas' => AreaUnidadProductiva::all(),
        ]);
    }

    /**
     * Guardar nueva emergencia.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_emergencia_id' => 'required|exists:tipo_emergencias,id',
            'descripcion' => 'required|string|max:255',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string|max:100',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            $ruta = $request->file('evidencia')->store('evidencias', 'public');
            $request->merge(['evidencia' => $ruta]);
        }

        Emergencia::create($request->all());

        return redirect()->route('emergencias.create')->with('success', 'Emergencia registrada con éxito.');
    }

    /**
     * Mostrar formulario para editar una emergencia existente.
     */
    public function edit($id)
    {
        $emergencia = Emergencia::with(['areaUnidadProductiva', 'tipoEmergencia', 'tipoRiesgo'])->findOrFail($id);
        $tiposEmergencia = TipoEmergencia::all();
        $tiposRiesgo = TipoRiesgo::all();
        $areas = AreaUnidadProductiva::all();

        return view('emergencias.edit', compact('emergencia', 'tiposEmergencia', 'tiposRiesgo', 'areas'));
    }

    /**
     * Actualizar emergencia existente.
     */
    public function update(Request $request, $id)
    {
        $emergencia = Emergencia::findOrFail($id);

        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'tipo_emergencia_id' => 'required|exists:tipo_emergencias,id',
            'descripcion' => 'required|string|max:255',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string|max:100',
            'evidencia' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('evidencia')) {
            // Eliminar archivo anterior si existe
            if ($emergencia->evidencia && Storage::disk('public')->exists($emergencia->evidencia)) {
                Storage::disk('public')->delete($emergencia->evidencia);
            }

            $ruta = $request->file('evidencia')->store('evidencias', 'public');
            $request->merge(['evidencia' => $ruta]);
        }

        try {
            $emergencia->update($request->all());
            return redirect()->route('emergencias.index')->with('success', 'Emergencia actualizada con éxito.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la emergencia: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar emergencia.
     */
    public function destroy($id)
    {
        $emergencia = Emergencia::findOrFail($id);

        if ($emergencia->evidencia && Storage::disk('public')->exists($emergencia->evidencia)) {
            Storage::disk('public')->delete($emergencia->evidencia);
        }

        $emergencia->delete();

        return redirect()->route('emergencias.index')->with('success', 'Emergencia eliminada correctamente.');
    }
}
