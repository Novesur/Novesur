<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValorizacionManobraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valorizacion_manobra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pk_informe_valorizacion');
            $table->foreign('pk_informe_valorizacion')->references('id')->on('informe_valorizacion');
            $table->unsignedBigInteger('personal_id');
            $table->foreign('personal_id')->references('id')->on('personal'); 
            $table->integer('dias')->required();
            $table->integer('horas')->required();
            $table->decimal('costdias', 8, 2)->required();
            $table->decimal('costhoras', 8, 2)->required();
            $table->decimal('total', 8, 2)->required();
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
        Schema::dropIfExists('valorizacion_manobra');
    }
}
