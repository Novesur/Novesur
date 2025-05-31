<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionLibreDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion_libre_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotizacionlibre_id');
            $table->foreign('cotizacionlibre_id')->references('id')->on('cotizacion_libre');
            $table->integer('cantidad')->required();
            $table->unsignedBigInteger('unidmedida_id');
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->string('producto')->required();
            $table->decimal('punit', 8, 3)->required();
            $table->decimal('pventa', 8, 3)->nullable();
            $table->boolean('EstadoNotPedido')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizacion_libre_detalle');
    }
}
