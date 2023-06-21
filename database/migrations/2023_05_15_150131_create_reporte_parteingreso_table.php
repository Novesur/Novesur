<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReporteParteingresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reporte_parteingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordencompras_id');
            $table->foreign('ordencompras_id')->references('id')->on('ordencompras');
            $table->unsignedBigInteger('parteingreso_id');
            $table->foreign('parteingreso_id')->references('id')->on('parteingreso');
            $table->date('fecha')->required();
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('cantidad')->required();
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
        Schema::dropIfExists('reporte_parteingreso');
    }
}
