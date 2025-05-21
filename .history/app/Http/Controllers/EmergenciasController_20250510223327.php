<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Emergencia;
use App\Models\AreaUnidadProductiva;
use App\Models\TipoEmergencia;
use App\Models\TipoRiesgo;
use Illuminate\Support\Facades\DB;

class EmergenciasController extends Controller
{
    public function index()
    {
$emergencias = Emergencia::with([
        'areaUnidadProductiva',
        'tipoEmergencia',
        'tipoRiesgo'
    ])->latest()->get();
    
    $areas = AreaUnidadProductiva::all();
    $tiposEmergencia = TipoEmergencia::all();
    $tiposRiesgo = TipoRiesgo::all();
    
    // Obtener estadísticas para la gráfica
    $datosGrafica = $this->obtenerDatosGrafica();
    
    return view('emergencias.lista_emergencias', compact(
        'emergencias', 
        'areas', 
        'tiposEmergencia', 
        'tiposRiesgo',
        'datosGrafica'
    ));
    }

    /**
     * Get emergency statistics by month for the current year
     */
    protected function getEmergenciasPorMes()
    {
        return Emergencia::select(
                DB::raw('MONTH(fecha_hora) as mes'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('fecha_hora', date('Y'))
            ->groupBy(DB::raw('MONTH(fecha_hora)'))
            ->orderBy('mes')
            ->get()
            ->mapWithKeys(function($item) {
                return [
                    $item->mes => [
                        'total' => $item->total,
                        'nombre_mes' => $this->getNombreMes($item->mes)
                    ]
                ];
            });
    }

    /**
     * Get month name from month number
     */
    protected function getNombreMes($mes)
    {
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
        
        return $meses[$mes] ?? 'Desconocido';
    }

    // Rest of your existing methods remain unchanged...
    public function create()
    {
        $areas = AreaUnidadProductiva::all();
        $tiposEmergencia = TipoEmergencia::all();
        $tiposRiesgo = TipoRiesgo::all();

        return view('emergencias.create', compact('areas', 'tiposEmergencia', 'tiposRiesgo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_emergencia_id' => 'required|exists:tipo_emergencias,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);

        Emergencia::create([
            'fecha_hora' => $request->fecha_hora,
            'area_unidad_productiva_id' => $request->area_unidad_productiva_id,
            'tipo_emergencia_id' => $request->tipo_emergencia_id,
            'tipo_riesgo_id' => $request->tipo_riesgo_id,
            'descripcion' => $request->descripcion,
            'evidencia' => $request->evidencia,
            'gravedad' => $request->gravedad,
            'creado_por' => $request->creado_por,
        ]);

        return redirect()->route('emergencias.create')->with('success', 'Emergencia registrada correctamente.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $emergencia = Emergencia::with([
            'areaUnidadProductiva',
            'tipoEmergencia',
            'tipoRiesgo'
        ])->findOrFail($id);

        $areas = AreaUnidadProductiva::all();
        $tiposEmergencia = TipoEmergencia::all();
        $tiposRiesgo = TipoRiesgo::all();

        return view('emergencias.edit', compact('emergencia', 'areas', 'tiposEmergencia', 'tiposRiesgo'));
    }

    public function update(Request $request, $id)
    {
        $emergencia = Emergencia::findOrFail($id);
        $validated = $request->validate([
            'fecha_hora' => 'required|date',
            'area_unidad_productiva_id' => 'required|exists:area_unidad_productiva,id',
            'tipo_emergencia_id' => 'required|exists:tipo_emergencias,id',
            'tipo_riesgo_id' => 'required|exists:tipo_riesgos,id',
            'descripcion' => 'nullable|string',
            'evidencia' => 'nullable|string',
            'gravedad' => 'required|in:leve,moderada,grave,fatal',
            'creado_por' => 'required|string',
        ]);
        
        try {
            $emergencia->update($validated);
            return redirect()->route('emergencias.index')->with('success', 'Emergencia actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar la emergencia: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }
}