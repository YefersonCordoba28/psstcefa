namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'ubicación',
        'tipo_evento',
        'descripción_evento',
        'personas_involucradas',
        'testigos',
        'evidencias',
        'creado_por',
        'fecha_registro',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;
}
