<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoLesion extends Model
{
    protected $table = 'tipo_lesiones';
    protected $fillable = ['nombre'];
}
