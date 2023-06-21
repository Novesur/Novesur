<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_extra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_extra_id');
            $table->foreign('plato_extra_id')->references('id')->on('plato_extra');
            $table->date('fecha')->required();
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
        Schema::dropIfExists('pedido_extra');
    }
}
