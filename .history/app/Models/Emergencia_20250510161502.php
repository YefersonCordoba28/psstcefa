<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'fecha_hora',
        'area_unidad_productiva_id',
        'tipo_emergencia_id',
        'tipo_riesgo_id',
        'descripcion',
        'evidencia',
        'gravedad',
        'creado_por',
    ];
    // Relaciones
    public function areaUnidadProductiva()
    {
        return $this->belongsTo(AreaUnidadProductiva::class);
    }
     public function tipoEmergencia()
    {
        return $this->belongsTo(TipoEmergencia::class);
    }
    public function tipoRiesgo()
    {
        return $this->belongsTo(TipoRiesgo::class);
    }
    
}
