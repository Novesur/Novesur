<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleMovimientoalmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_movimientoalmacen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movimiento_almacen_id')->required();
            $table->foreign('movimiento_almacen_id')->references('id')->on('movimiento_almacen');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('cantidad')->required();
            $table->decimal('peso', 5, 2)->required();
            $table->unsignedBigInteger('estadoprod_id')->required();
            $table->foreign('estadoprod_id')->references('id')->on('estadoprod');
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
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
        Schema::dropIfExists('detalle_movimientoalmacen');
    }
}
