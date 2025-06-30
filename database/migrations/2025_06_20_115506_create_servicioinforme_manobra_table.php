<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioinformeManobraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicioinforme_manobra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_servicio_informe');
            $table->foreign('pk_servicio_informe')->references('id')->on('servicio_informe');
            $table->string('personal',150)->nullable();
            $table->integer('dias')->required();
            $table->integer('horas')->required();
            $table->decimal('costdias', 8, 2)->required();
            $table->decimal('costhoras', 8, 2)->required();
            $table->decimal('total', 8, 2)->required();
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
        Schema::dropIfExists('servicioinforme_manobra');
    }
}
