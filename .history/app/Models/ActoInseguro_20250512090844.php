<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActoInseguro extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_hora',
        'area_unidad_productiva_id',
        'tipo_acto_inseguro_id',
        'tipo_riesgo_id',
        'descripcion',
        'evidencia',
        'gravedad',
    ];
    // Relaciones
    public function areaUnidadProductiva()
    {
        return $this->belongsTo(AreaUnidadProductiva::class);
    }
    public function tipoActoInseguro()
    {
        return $this->belongsTo(TipoActoInseguro::class);
    }
    public function tipoRiesgo()
    {
        return $this->belongsTo(TipoRiesgo::class);
    }
}
