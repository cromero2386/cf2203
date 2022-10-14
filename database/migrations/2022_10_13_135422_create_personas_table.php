<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo');
            $table->string('dni');
            $table->char('legajo', 6);
            $table->date('fechaNacimiento');
            $table->unsignedBigInteger('area_id');
            // Linea donde el indico a area_id con que clave primaria de que tabla se relaciona
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedBigInteger('barrio_id');
            // Linea donde el indico a barrio_id con que clave primaria de que tabla se relaciona
            $table->foreign('barrio_id')->references('id')->on('barrios');
            $table->unsignedBigInteger('provincia_id');
            // Linea donde el indico a provincia_id con que clave primaria de que tabla se relaciona
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
};
