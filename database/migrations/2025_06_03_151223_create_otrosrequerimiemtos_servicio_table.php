<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtrosrequerimiemtosServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otrosrequerimiemtos_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_Servicios');
            $table->foreign('pk_Servicios')->references('id')->on('servicio');
            $table->string('descripcion',150)->nullable();
            $table->string('cantidad',50)->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->string('descripcionServicio',150)->nullable();
            $table->string('cantidadServicio',50)->required();
            $table->unsignedBigInteger('unidmedida_idInfoValor');
            $table->foreign('unidmedida_idInfoValor')->references('id')->on('unidmedida');
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
        Schema::dropIfExists('otrosrequerimiemtos_servicio');
    }
}
