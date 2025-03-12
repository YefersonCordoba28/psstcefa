<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmergenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emergencias', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->string('ubicacion');
            $table->text('descripcion_emergencia');
            $table->enum('tipo_emergencia', ['Medica', 'Seguridad', 'Ambiental','estructural']);
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
        Schema::dropIfExists('emergencias');
    }
}
