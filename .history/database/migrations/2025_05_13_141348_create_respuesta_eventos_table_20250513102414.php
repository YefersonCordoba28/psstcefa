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

            // Identificador del evento y tipo
            $table->unsignedBigInteger('evento_id'); // Puede ser un ID de accidente, incidente, etc.
            $table->enum('tipo_evento', ['accidente', 'incidente', 'emergencia', 'acto_inseguro']);

            // Campos del formulario
            $table->text('respuesta')->nullable();
            $table->text('acciones_tomadas')->nullable();
            $table->dateTime('fecha_respuesta')->nullable();
            $table->string('respondido_por')->nullable();

            $table->timestamps();

            // NOTA: No se define foreign key porque depende del tipo_evento
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
