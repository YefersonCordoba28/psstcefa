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

            // Relaciones foráneas
            $table->foreignId('area_unidad_productiva_id')->constrained('area_unidad_productiva')->onDelete('cascade');
            $table->foreignId('tipo_acto_inseguro_id')->constrained('tipo_acto_inseguros')->onDelete('cascade');
            $table->foreignId('tipo_riesgo_id')->constrained('tipo_riesgos')->onDelete('cascade');

            // Campos adicionales
            $table->text('descripcion')->nullable();
            $table->text('evidencia')->nullable();
            $table->enum('gravedad', ['leve', 'moderada', 'grave'])->nullable();
            
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
