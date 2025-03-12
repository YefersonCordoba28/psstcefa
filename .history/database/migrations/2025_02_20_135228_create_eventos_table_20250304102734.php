<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->time('hora');
        $table->string('ubicación');
        $table->enum('tipo_evento', ['Accidente', 'Incidente', 'Emergencia']);
        $table->text('descripción_evento');
        $table->text('personas_involucradas')->nullable();
        $table->text('testigos')->nullable();
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
        Schema::dropIfExists('eventos');
    }
}
