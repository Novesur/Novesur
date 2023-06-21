<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotapedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notapedidos', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',20)->nullable();
            $table->unsignedBigInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacion');
            $table->date('fecha')->required();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('vendedor_id');
            $table->foreign('vendedor_id')->references('id')->on('users');
            $table->string('validezoferta',20);
            $table->string('Entrega',120);
            $table->foreign('tipopago_id')->references('id')->on('tipopago');
            $table->unsignedBigInteger('tipopago_id');
            $table->foreign('pago_id')->references('id')->on('pago');
            $table->unsignedBigInteger('pago_id');
            $table->string('flete',20);
            $table->string('documentacion',150);
            $table->unsignedBigInteger('garantia_id');
            $table->foreign('garantia_id')->references('id')->on('garantia');
            $table->string('punto_llegada',100)->nullable();
            $table->string('transporte',100)->nullable();
            $table->string('consignado',100)->nullable();
            $table->string('observacion')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('notapedidos');
    }
}
