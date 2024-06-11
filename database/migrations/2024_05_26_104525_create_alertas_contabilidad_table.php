<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasContabilidadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertas_contabilidad', function (Blueprint $table) {
            $table->id();
            $table->date('fRegistro')->required();
            $table->date('fVencimiento')->required();
            $table->string('obligacion',150)->required();
            $table->string('entidad',50)->required();
            $table->decimal('importe',8,2)->required();
            $table->unsignedBigInteger('tipocambio_id');
            $table->foreign('tipocambio_id')->references('id')->on('tipocambio');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('estadopedido_id');
            $table->foreign('estadopedido_id')->references('id')->on('estadopedido');
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
        Schema::dropIfExists('alertas_contabilidad');
    }
}
