<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorizacionReqmaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorizacion_reqmateriales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_informe_valorizacion');
            $table->foreign('pk_informe_valorizacion')->references('id')->on('informe_valorizacion');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->string('cantidad',10)->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->string('cantInfProd',10)->required();
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
        Schema::dropIfExists('valorizacion_reqmateriales');
    }
}
