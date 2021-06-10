<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')-> required();
            $table->char('ruc',11)-> required()->unique();
            $table->string('direccion')-> required();
            $table->string('telefono',150)-> required();
            $table->string('email')-> required();
            $table->string('contacto',50)-> required();
            $table->string('nrocuenta1',50);
            $table->string('nrocuenta2',50);
            $table->string('nrocuenta3',50);
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
        Schema::dropIfExists('proveedor');
    }
}
