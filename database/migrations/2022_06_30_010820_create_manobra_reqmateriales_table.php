<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManobraReqmaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manobra_reqmateriales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_ReqMateriales');
            $table->foreign('pk_ReqMateriales')->references('id')->on('requerimiento_materiales');
            $table->string('personal',150)->nullable();
            $table->integer('dias')->required();
            $table->integer('horas')->required();
            $table->string('personalInfoProd',150)->nullable();
            $table->integer('diasInfoProd')->required();
            $table->integer('horasInfoProd')->required();
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
        Schema::dropIfExists('manobra_reqmateriales');
    }
}
