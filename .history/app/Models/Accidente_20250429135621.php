<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accidente extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_hora',
        'area_unidad_productiva_id',
        'tipo_lesion_id',
        'tipo_riesgo_id',
        'tipo_accidente_id',
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

    public function tipoLesion()
    {
        return $this->belongsTo(TipoLesion::class);
    }

    public function tipoRiesgo()
    {
        return $this->belongsTo(TipoRiesgo::class);
    }

    public function tipoAccidente()
    {
        return $this->belongsTo(TipoAccidente::class);
 
    }
}