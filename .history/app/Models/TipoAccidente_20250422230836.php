<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAccidente extends Model
{
    protected $table = 'tipo_accidentes';
    protected $fillable = ['nombre'];
}