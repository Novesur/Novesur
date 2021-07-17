<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleparteingresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleparteingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parteingreso_id');
            $table->foreign('parteingreso_id')->references('id')->on('parteingreso');
            $table->unsignedBigInteger('ordencompras_id');
            $table->foreign('ordencompras_id')->references('id')->on('ordencompras');
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
        Schema::dropIfExists('detalleparteingreso');
    }
}
