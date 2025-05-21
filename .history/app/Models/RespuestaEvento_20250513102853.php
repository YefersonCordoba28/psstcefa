<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaEvento extends Model
{
    use HasFactory;

    protected $table = 'respuestas_eventos';
    protected $fillable = [
        'evento_id',
        'tipo_evento',
        'respuesta',
        'acciones_tomadas',
        'fecha_respuesta',
        'respondido_por',
    ];

    public function evento()
    {
        s
    }
}
