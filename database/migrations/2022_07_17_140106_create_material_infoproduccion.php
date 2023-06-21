<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialInfoproduccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_infoproduccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('informeproduccion_id');
            $table->foreign('informeproduccion_id')->references('id')->on('informeproduccion');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->string('cantidad',4)->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->date('fecha')->required();
            $table->decimal('costunit', 8, 2)->required();
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
        Schema::dropIfExists('material_infoproduccion');
    }
}
