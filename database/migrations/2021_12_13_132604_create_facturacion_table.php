<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturacion', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',15)->nullable();
            $table->date('fEmision')->required();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->char('nroguia',20)->required();
            $table->char('ordencompra',12)->required();
            $table->date('fVencimiento')->required();
            $table->unsignedBigInteger('pago_id');
            $table->foreign('pago_id')->references('id')->on('pago');
            $table->string('observacion',100)->nullable();
          /*   $table->unsignedBigInteger('estadoparte_id');
            $table->foreign('estadoparte_id')->references('id')->on('estadoparte'); */
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
        Schema::dropIfExists('facturacion');
    }
}
