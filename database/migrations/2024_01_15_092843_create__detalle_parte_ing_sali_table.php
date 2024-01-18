<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleParteIngSaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_parte_ing_sali', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parte_ing_sali_id');
            $table->foreign('parte_ing_sali_id')->references('id')->on('parte_ing_sali');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->decimal('cantidad', 8, 2)->required();
            $table->unsignedBigInteger('unidmedida_id')->required();
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida'); 
            $table->double('punit');
            $table->unsignedBigInteger('estadopedido_id')->required();
            $table->foreign('estadopedido_id')->references('id')->on('estadopedido'); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_parte_ing_sali');
    }
}
