<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countable', function (Blueprint $table) {
            $table->id();
            $table->integer('countcotizacion')->required();
            $table->integer('countnotapedido')->required();
            $table->integer('countordencompra')->required();
            $table->integer('countordenservicio')->required();
            $table->integer('countreqmateriales')->required();
            $table->integer('countinfoproduccion')->required();
            $table->integer('countordencompraPiura')->required();
            $table->integer('countordenservicioPiura')->required();
            $table->integer('countProyectReqMaterial')->required();
            $table->integer('countInformeValorizacion')->required();
            $table->integer('countGuiaInterna')->required();
            $table->integer('countGuiaExterna')->required();
            $table->integer('countAlmacenGuiaExterna')->required();
            $table->integer('countAlmacenGuiaInterna')->required();

            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countable');
    }
}
