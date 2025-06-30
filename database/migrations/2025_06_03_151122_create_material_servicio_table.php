<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_Servicios');
            $table->foreign('pk_Servicios')->references('id')->on('servicio');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->string('cantidad',10)->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->string('cantServicio',10)->required();
            $table->unsignedBigInteger('unidmedidaInfoValor_id');
            $table->foreign('unidmedidaInfoValor_id')->references('id')->on('unidmedida');
            $table->date('fecha')->required();
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
        Schema::dropIfExists('material_servicio');
    }
}
