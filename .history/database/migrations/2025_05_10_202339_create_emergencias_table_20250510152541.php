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

            $table->dateTime('fecha_hora')->nullable();
            $table->unsignedBigInteger('area_unidad_productiva_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->text('evidencia')->nullable();
            $table->enum('gravedad', ['leve', 'moderada', 'grave'])->nullable();
            $table->text('acto_especifico')->nullable();

            $table->unsignedBigInteger('tipo_riesgo_id')->nullable();
            $table->unsignedBigInteger('tipo_acto_inseguro_id')->nullable();

            $table->timestamps();

            // Relaciones
            $table->foreign('area_unidad_productiva_id')->references('id')->on('areas_unidad_productiva')->onDelete('set null');
            $table->foreign('tipo_acto_inseguro_id')->references('id')->on('tipos_actos_inseguros')->onDelete('set null');
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
