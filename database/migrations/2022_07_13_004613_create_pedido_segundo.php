<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoSegundo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_segundo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_segundo_id');
            $table->foreign('plato_segundo_id')->references('id')->on('plato_segundo');
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
        Schema::dropIfExists('pedido_segundo');
    }
}
