<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiaremisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guiaremision', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',15)->nullable();
            $table->date('fechainicio')->required();
            $table->unsignedBigInteger('tipo_traslado_id');
            $table->foreign('tipo_traslado_id')->references('id')->on('tipo_traslado');
            $table->unsignedBigInteger('puntopartida_id')->unsigned();
            $table->foreign('puntopartida_id')->references('id')->on('almacen');
            $table->unsignedBigInteger('puntollegada_id')->unsigned();
            $table->foreign('puntollegada_id')->references('id')->on('almacen');
            $table->unsignedBigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->string('placaconductor',10)->required();
            $table->unsignedBigInteger('motivotraslado_id')->unsigned();
            $table->foreign('motivotraslado_id')->references('id')->on('motivotraslado');
            $table->unsignedBigInteger('modalidadtransporte_id')->unsigned();
            $table->foreign('modalidadtransporte_id')->references('id')->on('modalidadtransporte');
            $table->char('dniconductor',8)->required();
            $table->decimal('pesototal',8,3)->required();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('estadopedido_id');
            $table->foreign('estadopedido_id')->references('id')->on('estadopedido');
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
        Schema::dropIfExists('guiaremision');
    }
}
