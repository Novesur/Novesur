<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformeValorizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_valorizacion', function (Blueprint $table) {
            $table->id();
            $table->char('codigo',20)->required();
            $table->date('fecha')->required();
            $table->unsignedBigInteger('centro_costos_id');
            $table->foreign('centro_costos_id')->references('id')->on('centro_costos');
            $table->string('cliente',150)->nullable()->required();
            $table->string('detservicio',150)->nullable();
            $table->date('fechainicio')->required();
            $table->date('fechafinal')->required();
            $table->integer('duracion')->required();
            $table->string('ord_servicio',250)->unique()->required();
            $table->decimal('importe', 8, 2)->required();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('pk_proyecto_reqmateriales');
            $table->foreign('pk_proyecto_reqmateriales')->references('id')->on('proyecto_reqmateriales');
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
        Schema::dropIfExists('informe_valorizacion');
    }
}
