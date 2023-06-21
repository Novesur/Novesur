<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('razonsocial',200)-> required();
            $table->string('direccion')-> required();
            $table->char('ruc',11)-> required()->unique();
            $table->string('atencion',50)->nullable();
            $table->string('telefono',50)->nullable();
            $table->string('celular',50)->nullable();
            $table->string('email',50)->nullable();
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->unsignedBigInteger('usuario_id');
            $table->enum('tipoPrecio', ['Lista', 'Distribuidor']);
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
        Schema::dropIfExists('cliente');
    }
}
