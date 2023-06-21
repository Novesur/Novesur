<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallenotaventaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallenotaventa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notaventa_id');
            $table->foreign('notaventa_id')->references('id')->on('notaventa');
            $table->integer('cantidad')->required();
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->decimal('punit', 8, 3)->required();
            $table->unsignedBigInteger('estadoprod_id')->required();
            $table->foreign('estadoprod_id')->references('id')->on('estadoprod');
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
        Schema::dropIfExists('detallenotaventa');
    }
}
