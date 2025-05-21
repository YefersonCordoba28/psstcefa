<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoRiesgo extends Model
{
    protected $table = 'tipo_riesgo';
    protected $fillable = ['nombre'];
}