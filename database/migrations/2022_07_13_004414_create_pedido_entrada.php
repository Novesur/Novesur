<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoEntrada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_entrada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_entrada_id');
            $table->foreign('plato_entrada_id')->references('id')->on('plato_entrada');
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
        Schema::dropIfExists('pedido_entrada');
    }
}
