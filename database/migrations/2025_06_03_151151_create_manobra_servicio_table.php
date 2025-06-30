<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManobraServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manobra_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_Servicios');
            $table->foreign('pk_Servicios')->references('id')->on('servicio');
            $table->string('personal',150)->nullable();
            $table->integer('dias')->required();
            $table->integer('horas')->required();
            $table->string('personalServicio',150)->nullable();
            $table->integer('diasServicio')->required();
            $table->integer('horasServicio')->required();
            $table->char('estado',1)->required();
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
        Schema::dropIfExists('manobra_servicio');
    }
}
