<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioinformeOtrosrequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicioinforme_otrosrequerimientos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_servicio_informe');
            $table->foreign('pk_servicio_informe')->references('id')->on('servicio_informe');
            $table->string('descripcion',150)->nullable();
            $table->string('cantidad',50)->required();
            $table->decimal('precio', 8, 2)->required();
            $table->decimal('alquiler', 8, 2)->required();
            $table->unsignedBigInteger('pk_tiempo_alquiler');
            $table->foreign('pk_tiempo_alquiler')->references('id')->on('tiempo_alquiler');
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
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
        Schema::dropIfExists('servicioinforme_otrosrequerimientos');
    }
}
