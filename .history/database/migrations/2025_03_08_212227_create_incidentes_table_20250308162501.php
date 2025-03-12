<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $table->id();
        $table->dateTime('fecha_hora');
        $table->string('ubicacion');
        $table->text('descripcion_incidente');
        $table->enum('riesgo', ['Bajo', 'Moderado', 'Alto',]);
        $table->enum('estado', ['pendiente', 'en investigacion','finalizado'])->default('Pendiente');
        $table->string('evidencias')->nullable(); 
        $table->string('creado_por');
        $table->timestamp('fecha_registro')->useCurrent();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidentes');
    }
}
