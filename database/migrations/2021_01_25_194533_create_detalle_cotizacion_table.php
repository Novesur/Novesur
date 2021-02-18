<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotizacion_id');
            $table->foreign('cotizacion_id')->references('id')->on('cotizacion');
            $table->integer('cantidad')->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->decimal('punit', 8, 2)->required();
            $table->string('validezoferta',20);
            $table->string('Entrega',120);
            $table->foreign('tipopago_id')->references('id')->on('tipopago');
            $table->unsignedBigInteger('tipopago_id');
            $table->string('descripcionTipopago')->nullable();;
            $table->string('flete',20);
            $table->string('documentacion',50);
            $table->string('garantia');
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
        Schema::dropIfExists('detalle_cotizacion');
    }
}
