<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoDietaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_dieta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plato_dieta_id');
            $table->foreign('plato_dieta_id')->references('id')->on('plato_dieta');
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
        Schema::dropIfExists('pedido_dieta');
    }
}
