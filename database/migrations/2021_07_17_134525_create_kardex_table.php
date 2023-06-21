<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexTable extends Migration
{

    public function up()
    {
        Schema::create('kardex', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id')->required()->unique();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('stock')->required();
            $table->decimal('costunit', 8, 2)->required();
            $table->decimal('diferencia', 8, 2)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('kardex');
    }
}
