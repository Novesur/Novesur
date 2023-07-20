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
            $table->decimal('alquiler', 8, 2)->required();
            $table->unsignedBigInteger('pk_tiempo_alquiler');
            $table->foreign('pk_tiempo_alquiler')->references('id')->on('tiempo_alquiler');
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->decimal('total', 8, 2)->required();
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
        Schema::dropIfExists('valorizacion_otrosreq');
    }
}
