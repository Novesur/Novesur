<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtrosrequerimientosInfoproduccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otrosrequerimientos_infoproduccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('informeproduccion_id');
            $table->foreign('informeproduccion_id')->references('id')->on('informeproduccion');
            $table->string('descripcion',150)->nullable();
            $table->string('cantidad',50)->required();
            $table->decimal('precio', 8, 2)->required();
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
        Schema::dropIfExists('otrosrequerimientos_infoproduccion');
    }
}
