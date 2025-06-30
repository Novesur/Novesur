<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicioInformeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicio_informe', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',15)->required();
            $table->date('fecha')->required();
            $table->string('cliente',150)->nullable()->required();
            $table->string('detservicio',150)->nullable();
            $table->integer('cantidad')->required();
            $table->date('fechainicio')->required();
            $table->date('fechafinal')->required();
            $table->integer('duracion')->required();
            $table->string('ord_servicio',250)->unique()->required();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('servicio_informe');
    }
}
