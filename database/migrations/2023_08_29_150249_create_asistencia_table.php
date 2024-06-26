<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
          
            $table->id();
            $table->integer('asistencia')->nullable();
            $table->string('fecha',10)->nullable();
            $table->string('tiempo',10)->nullable();
            $table->unsignedBigInteger('asistencia_estado_id');
            $table->foreign('asistencia_estado_id')->references('id')->on('asistencia_estado'); 
            $table->string('estado',1)->required();
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
        Schema::dropIfExists('asistencia');
    }
}
