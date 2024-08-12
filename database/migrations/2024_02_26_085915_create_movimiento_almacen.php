<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientoAlmacen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimiento_almacen', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',15)->nullable();
            $table->date('fechaemision')->required();
            $table->date('fechaenvio')->required();
            $table->unsignedBigInteger('tipo_traslado_id');
            $table->string('comprobante',50)->required();
            $table->foreign('tipo_traslado_id')->references('id')->on('tipo_traslado');
            $table->unsignedBigInteger('puntopartida_id')->unsigned();
            $table->foreign('puntopartida_id')->references('id')->on('almacen');
            $table->unsignedBigInteger('puntollegada_id')->unsigned();
            $table->foreign('puntollegada_id')->references('id')->on('almacen');
            $table->unsignedBigInteger('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->string('placaconductor',10)->nullable();
            $table->unsignedBigInteger('motivotraslado_id')->unsigned();
            $table->foreign('motivotraslado_id')->references('id')->on('motivotraslado');
            $table->unsignedBigInteger('modalidadtransporte_id')->unsigned();
            $table->foreign('modalidadtransporte_id')->references('id')->on('modalidadtransporte');
            $table->char('dniconductor',12)->nullable();
            $table->decimal('pesototal',8,3)->nullable();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('estadopedido_id');
            $table->foreign('estadopedido_id')->references('id')->on('estadopedido');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('nbultos')->nullable();
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
        Schema::dropIfExists('movimiento_almacen');
    }
}
