<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaInvolucrada extends Model
{
    use HasFactory;

    protected $table = 'personas_involucradas';

    protected $fillable = [
        'accidente_id',
        'nombre',
        'apellido',
        'cargo_id',
    ];

    /**
     * Relación: Persona involucrada pertenece a un accidente
     */
    public function accidente()
    {
        return $this->belongsTo(Accidente::class);
    }

    /**
     * Relación: Persona involucrada tiene un cargo
     */
    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
