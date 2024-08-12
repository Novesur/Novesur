<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParteIngSaliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_ing_sali', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',12);
            $table->string('Nrofactura',30)->nullable();
            $table->string('Nroguia',30)->nullable();
            $table->string('Nroordencompras',20)->nullable();
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedor');
            $table->unsignedBigInteger('motivo_id');
            $table->foreign('motivo_id')->references('id')->on('motivo');
            $table->date('Fecha');
            $table->string('observacion',200)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('almacen_id');
            $table->foreign('almacen_id')->references('id')->on('almacen');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->unsignedBigInteger('movimiento_id');
            $table->foreign('movimiento_id')->references('id')->on('movimiento');
            $table->unsignedBigInteger('estadopedido_id');
            $table->foreign('estadopedido_id')->references('id')->on('estadopedido');
            $table->string('Nroordenservicio',20)->nullable();
            $table->enum('tipo_orden', ['C', 'S', 'N']); // C = Compra , S = Servicio , N = Ninguno
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
        Schema::dropIfExists('parte_ing_sali');
    }
}
