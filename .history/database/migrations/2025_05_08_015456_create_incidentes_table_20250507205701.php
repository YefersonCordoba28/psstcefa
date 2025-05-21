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
        Schema::create('incidentes', function (Blueprint $table) {
        $table->id();
        $table->dateTime('fecha_hora');

        // Relaciones foráneas
        $table->foreignId('area_unidad_productiva_id')->constrained('area_unidad_productiva')->onDelete('cascade');
        $table->foreignId('tipo_riesgo_id')->constrained('tipo_riesgos')->onDelete('cascade');
        $table->foreignId('tipo_incidente_id')->constrained('tipo_incidentes')->onDelete('cascade');

        // Campos adicionales
        $table->text('descripcion')->nullable();
        $table->text('evidencia')->nullable(); // Puede ser archivo(s), enlace o JSON
        $table->enum('gravedad', ['leve', 'moderada', 'grave', 'fatal'])->nullable();
        $table->enum('nivel_riesgo', ['Alto', 'Medio', 'grave', 'fatal']); // puedes ajustar los valores
        $table->string('creado_por'); // Nombre o ID del usuario que lo creó

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
