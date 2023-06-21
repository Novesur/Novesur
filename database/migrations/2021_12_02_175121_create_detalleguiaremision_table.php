<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleguiaremisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleguiaremision', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guiaremision_id')->required();
            $table->foreign('guiaremision_id')->references('id')->on('guiaremision');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('cantidad')->required();
            $table->unsignedBigInteger('unidmedida_id')->required();
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
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
        Schema::dropIfExists('detalleguiaremision');
    }
}
