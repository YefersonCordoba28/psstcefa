<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestaEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuesta_eventos', function (Blueprint $table) {
             $table->id();
            
            // Relaciones foráneas
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');

            // Campos
            $table->text('respuesta')->nullable();
            $table->text('acciones_tomadas')->nullable();
            $table->dateTime('fecha_respuesta')->nullable();
            $table->string('respondido_por')->nullable();
            
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
        Schema::dropIfExists('respuesta_eventos');
    }
}
