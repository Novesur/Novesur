<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioinformeMaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicioinforme_materiales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_servicio_informe');
            $table->foreign('pk_servicio_informe')->references('id')->on('servicio_informe');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->string('cantidad',10)->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->date('fecha')->required();
            $table->decimal('costunit', 8, 2)->required();
            $table->decimal('total', 8, 2)->required();
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
        Schema::dropIfExists('servicioinforme_materiales');
    }
}
