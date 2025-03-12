<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccidentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accidentes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->string('ubicacion');
            $table->text('descripcion_accidente');
            $table->text('personas_involucradas')->nullable();
            $table->enum('gravedad', ['Leve', 'Moderado', 'Grave',]);
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
        Schema::dropIfExists('accidentes');
    }
}
