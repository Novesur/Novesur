<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtrosrequerimientosReqmaterialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otrosrequerimientos_reqmateriales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_ReqMateriales');
            $table->foreign('pk_ReqMateriales')->references('id')->on('requerimiento_materiales');
            $table->string('descripcion',150)->nullable();
            $table->string('cantidad',50)->required();
            $table->string('descripcionInfoProd',150)->nullable();
            $table->string('cantidadInfoProd',50)->required();
            $table->char('estado',1)->required();
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
        Schema::dropIfExists('otrosrequerimientos_reqmateriales');
    }
}
