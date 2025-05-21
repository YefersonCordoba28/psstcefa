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
            
            // Relaciones foráneas
            $table->foreignId('area_unidad_productiva_id')->constrained('area_unidad_productiva')->onDelete('cascade');
            $table->foreignId('tipo_lesion_id')->constrained('tipo_lesion')->onDelete('cascade');
            $table->foreignId('tipo_riesgo_id')->constrained('tipo_riesgos')->onDelete('cascade');
            $table->foreignId('tipo_accidente_id')->constrained('tipo_accidentes')->onDelete('cascade');

            // Campos adicionales
            $table->text('descripcion')->nullable();
            $table->text('evidencia')->nullable();
            $table->enum('gravedad', ['leve', 'moderada', 'grave', 'fatal']); // puedes ajustar los valores
            $table->string('creado_por');
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
