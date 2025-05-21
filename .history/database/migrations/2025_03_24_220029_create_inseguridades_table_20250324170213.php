<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInseguridadesTable extends Migration
{
    public function up()
    {
        Schema::create('inseguridades', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->dateTime('fecha_hora'); // Fecha y hora del reporte
            $table->string('area_productiva'); // Área o unidad productiva
            $table->enum('tipo_inseguridad', ['acto_inseguro', 'condicion_insegura']); // Tipo de inseguridad
            $table->string('lugar_inseguridad'); // Lugar específico
            $table->text('descripcion_inseguridad'); // Descripción detallada
            $table->string('evidencia')->nullable(); // Ruta de la imagen (puede ser nulo)
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('inseguridades');
    }
}