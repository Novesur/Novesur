<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservacionPapeletaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observacion_papeleta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('papeletasalida_id');
            $table->foreign('papeletasalida_id')->references('id')->on('papeletasalida');
            $table->string('observacion')->nullable();
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
        Schema::dropIfExists('observacion_papeleta');
    }
}
