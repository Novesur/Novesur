<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorizacionOtrosreqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorizacion_otrosreq', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_informe_valorizacion');
            $table->foreign('pk_informe_valorizacion')->references('id')->on('informe_valorizacion');
            $table->string('descripcion',150)->nullable();
            $table->string('cantidad',50)->required();
            $table->decimal('precio', 8, 2)->required();
            $table->integer('alquiler')->required();
            $table->unsignedBigInteger('pk_tiempo_alquiler');
            $table->foreign('pk_tiempo_alquiler')->references('id')->on('tiempo_alquiler');
            $table->string('descripcionInfoProy',150)->nullable();
            $table->string('cantidadInfoProy',50)->required();
            $table->integer('alquilerInfoProy')->required();
            $table->decimal('precioInfoProy', 8, 2)->required();
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
        Schema::dropIfExists('valorizacion_otrosreq');
    }
}
