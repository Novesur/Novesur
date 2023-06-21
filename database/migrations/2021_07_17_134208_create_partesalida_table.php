<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartesalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partesalida', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',12);
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->string('Nrofactura',30)->unique()->required();
            $table->string('Nroguia',30)->unique()->required();
            $table->unsignedBigInteger('motivo_id');
            $table->foreign('motivo_id')->references('id')->on('motivo');
            $table->date('Fecha');
            $table->string('observacion',200);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        /*     $table->unsignedBigInteger('estadoparte_id');
            $table->foreign('estadoparte_id')->references('id')->on('estadoparte'); */
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
        Schema::dropIfExists('partesalida');
    }
}
