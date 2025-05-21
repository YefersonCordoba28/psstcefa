<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmergencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
    ];
    // Relaciones
    public function emergencias()
    {
        return $this->hasMany(Emergencia::class);
    }
    public function tipoActoInseguro()
    {
        return $this->hasMany(TipoActoInseguro::class);
    }
    public function tipoAccidente()
    {
        return $this->hasMany(TipoAccidente::class);
    }
}
