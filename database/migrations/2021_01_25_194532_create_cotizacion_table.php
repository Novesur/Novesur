<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->required();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('estadopedido_id');
            $table->foreign('estadopedido_id')->references('id')->on('estadopedido');
            $table->string('validezoferta',20);
            $table->string('Entrega',120);
            $table->foreign('tipopago_id')->references('id')->on('tipopago');
            $table->unsignedBigInteger('tipopago_id');
            $table->foreign('pago_id')->references('id')->on('pago');
            $table->unsignedBigInteger('pago_id');
            $table->string('flete',150);
            $table->string('documentacion',150);
            $table->unsignedBigInteger('garantia_id');
            $table->foreign('garantia_id')->references('id')->on('garantia');
            $table->string('punto_llegada',100)->nullable();
            $table->string('transporte',100)->nullable();
            $table->string('consignado',100)->nullable();
            $table->string('observacion')->nullable();
            $table->char('codigo',12)->nullable();
            $table->date('fechacotiupdate')->nullable();
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
        Schema::dropIfExists('cotizacion');
    }
}
