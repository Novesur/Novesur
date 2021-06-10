<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdencomprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordencompras', function (Blueprint $table) {
            $table->id();
            $table->date('Femision');
            $table->string('Referencia',150);
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedor');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('observaciones',150);
            $table->date('Fentrega');
            $table->string('LugarEntrega',150);
            $table->unsignedBigInteger('tipordercompra_id');
            $table->foreign('tipordercompra_id')->references('id')->on('tipordercompra');
            $table->unsignedBigInteger('pago_id');
            $table->foreign('pago_id')->references('id')->on('pago');
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
        Schema::dropIfExists('ordencompras');
    }
}
