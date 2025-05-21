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
        'tipo_riesgo_id',
        'tipo_emergencia_id',
        'descripcion',
        'evidencia',
        'nivel_riesgo',
        'creado_por',
    ];
    // Relaciones
    public function areaUnidadProductiva()
    {
        return $this->belongsTo(AreaUnidadProductiva::class);
    }
}
