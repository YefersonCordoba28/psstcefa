<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaUnidadProductivaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_unidad_productiva', function (Blueprint $table) {
            $table->id(); // Clave primaria (id int)
            $table->string('nombre'); // Campo nombre (varchar)
            $table->text('descripcion')->nullable(); // Campo descripcion (text, opcional)
            $table->timestamps(); // Campos created_at y updated_at (timestamp)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_unidad_productiva');
    }
}
