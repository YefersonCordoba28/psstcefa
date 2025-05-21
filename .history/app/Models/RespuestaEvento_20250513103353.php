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

    protected $casts = [
        'fecha_respuesta' => 'datetime',
    ];

    // Relaciones según el tipo de evento
    public function accidente()
    {
        return $this->belongsTo(Accidente::class, 'evento_id');
    }

    public function incidente()
    {
        return $this->belongsTo(Incidente::class, 'evento_id');
    }

    public function emergencia()
    {
        return $this->belongsTo(Emergencia::class, 'evento_id');
    }

    public function actoInseguro()
    {
        return $this->belongsTo(ActoInseguro::class, 'evento_id');
    }

    // Relación dinámica con el evento
    public function evento()
    {
        switch ($this->tipo_evento) {
            case 'accidente':
                return $this->accidente();
            case 'incidente':
                return $this->incidente();
            case 'emergencia':
                return $this->emergencia();
            case 'acto_inseguro':
                return $this->actoInseguro();
            default:
                return null;
        }
    }
}