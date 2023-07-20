<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoOtrosreqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_otrosreq', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_proyecto_reqmateriales');
            $table->foreign('pk_proyecto_reqmateriales')->references('id')->on('proyecto_reqmateriales');
            $table->string('descripcion', 150)->nullable();
            $table->string('cantidad', 50)->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->string('descripcionInfoValor', 150)->nullable();
            $table->string('cantidadInfoValor', 50)->required();
            $table->unsignedBigInteger('unidmedida_idInfoValor');
            $table->foreign('unidmedida_idInfoValor')->references('id')->on('unidmedida');
            $table->char('estado', 1)->required();
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
        Schema::dropIfExists('proyecto_otrosreq');
    }
}
