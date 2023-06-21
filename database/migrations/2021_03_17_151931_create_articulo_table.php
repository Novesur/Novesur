<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticuloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 200)->unique()->required();
            $table->foreign('tipo_id')->references('id')->on('tipo');
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('file_id')->references('id')->on('files');
            $table->unsignedBigInteger('file_id');
            $table->foreign('catarticulo_id')->references('id')->on('catarticulo');
            $table->unsignedBigInteger('catarticulo_id');
            $table->string('descripcion');
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
        Schema::dropIfExists('articulo');
    }
}
