<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProyectoManobraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyecto_manobra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_proyecto_reqmateriales');
            $table->foreign('pk_proyecto_reqmateriales')->references('id')->on('proyecto_reqmateriales');
            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')->references('id')->on('personal');
            $table->integer('dias')->required();
            $table->integer('horas')->required();
            $table->string('personalInfoValor',150)->nullable();
            $table->integer('diasInfoValor')->required();
            $table->integer('horasInfoValor')->required();
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
        Schema::dropIfExists('proyecto_manobra');
    }
}
