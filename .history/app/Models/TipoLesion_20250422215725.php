<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoLesion extends Model
{
    protected $table = 'tipo_lesion';
    protected $fillable = ['nombre'];
}