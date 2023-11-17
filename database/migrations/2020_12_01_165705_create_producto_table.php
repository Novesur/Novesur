<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->id();

            $table->char('codigo',30)->unique()-> required();

            $table->unsignedBigInteger('familia_id');
            $table->foreign('familia_id')->references('id')->on('familia');

            $table->unsignedBigInteger('subfamilia_id');
            $table->foreign('subfamilia_id')->references('id')->on('subfamilia');

            $table->unsignedBigInteger('modelotipo_id');
            $table->foreign('modelotipo_id')->references('id')->on('modelotipo');

            $table->unsignedBigInteger('marca_id');
            $table->foreign('marca_id')->references('id')->on('marca');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('material');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estadoprod');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('homologacion_id');
            $table->foreign('homologacion_id')->references('id')->on('homologacion');

            $table->decimal('precioSugerido', 8, 3)->nullable();

            $table->decimal('precioDistribuidor', 8, 3)->nullable();

            $table->integer('stock')->default(0);

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
        Schema::dropIfExists('producto');
    }
}
