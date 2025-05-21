<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIncidente extends Model
{
    protected $table = 'tipo_incidentes';
    protected $fillable = ['nombre'];
}
