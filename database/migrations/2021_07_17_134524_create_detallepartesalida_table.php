<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallepartesalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallepartesalida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partesalida_id');
            $table->foreign('partesalida_id')->references('id')->on('partesalida');
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
        Schema::dropIfExists('detallepartesalida');
    }
}
