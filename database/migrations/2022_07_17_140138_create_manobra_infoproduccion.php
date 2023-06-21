<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManobraInfoproduccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manobra_infoproduccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('informeproduccion_id');
            $table->foreign('informeproduccion_id')->references('id')->on('informeproduccion');
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
        Schema::dropIfExists('manobra_infoproduccion');
    }
}
