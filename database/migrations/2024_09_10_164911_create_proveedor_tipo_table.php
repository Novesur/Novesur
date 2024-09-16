<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorTipoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proveedor', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_ordencompra_id')->default(1);
            $table->foreign('tipo_ordencompra_id')->references('id')->on('tipo_ordencompra');
            $table->string('swift',15)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor_tipo');
    }
}
