<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapeletasalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papeletasalida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('fecha')->required();
            $table->time('horasalida')->required();
            $table->time('horaretorno')->required();
            $table->unsignedBigInteger('motivopapeletasalida_id');
            $table->foreign('motivopapeletasalida_id')->references('id')->on('motivopapeletasalida');
            $table->unsignedBigInteger('estadopapeletasalida_id');
            $table->foreign('estadopapeletasalida_id')->references('id')->on('estadopapeletasalida');
            $table->string('fundamento',150)->required();
            $table->string('observacion',250)->nullable();
            $table->time('hora_emision')->required();
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
        Schema::dropIfExists('papeletasalida');
    }
}
