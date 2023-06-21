<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParteingresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parteingreso', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',12);
            $table->string('Nrofactura',30)->nullable();
            $table->string('Nroguia',30)->nullable();
            $table->unsignedBigInteger('ordencompras_id');
            $table->foreign('ordencompras_id')->references('id')->on('ordencompras');
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedor');
            $table->unsignedBigInteger('motivo_id');
            $table->foreign('motivo_id')->references('id')->on('motivo');
            $table->date('Fecha');
            $table->string('observacion',200);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('parteingreso');
    }
}
