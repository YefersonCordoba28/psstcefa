<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaUnidadProductiva extends Model
{
    protected $table = 'areas_unidad_productiva'; // Nombre exacto de la tabla
    protected $fillable = ['nombre', 'descripcion']; // Campos que se pueden llenar
}