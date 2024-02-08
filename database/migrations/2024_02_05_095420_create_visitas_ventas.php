<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitasVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->required();
            $table->string('tiempo',10)->nullable();
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamento'); 
            $table->unsignedBigInteger('provincia_id');
            $table->foreign('provincia_id')->references('id')->on('provincia'); 
            $table->unsignedBigInteger('distrito_id');
            $table->foreign('distrito_id')->references('id')->on('distrito'); 
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente'); 
            $table->string('proyecto',50)->required();
            $table->string('direccion',150)->required();
            $table->unsignedBigInteger('estado_obra_id');
            $table->foreign('estado_obra_id')->references('id')->on('estado_obra'); 
            $table->unsignedBigInteger('personal_contacto_id');
            $table->foreign('personal_contacto_id')->references('id')->on('personal_contacto'); 
            $table->string('nombre',150)->required();
            $table->string('observacion',150)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('visitas_ventas');
    }
}
