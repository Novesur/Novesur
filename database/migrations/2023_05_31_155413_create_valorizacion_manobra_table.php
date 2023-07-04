<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorizacionManobraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorizacion_manobra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_informe_valorizacion');
            $table->foreign('pk_informe_valorizacion')->references('id')->on('informe_valorizacion');
            $table->string('personal',150)->nullable();
            $table->integer('dias')->required();
            $table->integer('horas')->required();
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
        Schema::dropIfExists('valorizacion_manobra');
    }
}
