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
            $table->char('ruc',13)-> required()->unique();
            $table->string('direccion')-> required();
            $table->string('telefono',150)-> required();
            $table->string('email')-> required();
            $table->string('contacto',50)-> required();
            $table->string('nrocuenta1',150);
            $table->string('nrocuenta2',150);
            $table->string('nrocuenta3',150);
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
