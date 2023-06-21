<?php

use App\Ordenservicio;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleordenservicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleordenservicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordenservicio_id');
            $table->foreign('ordenservicio_id')->references('id')->on('ordenservicio');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
           // $table->integer('cantidad')->required();
            $table->decimal('cantidad',8,1)->required();
            $table->integer('cantidadKardex');
            $table->unsignedBigInteger('unidmedida_id')->required();
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            /* $table->decimal('punit', 8, 4)->required(); */
            $table->double('punit')->required();
            $table->enum('estado',[Ordenservicio::ATENDIDO,Ordenservicio::ANULADO])->default(Ordenservicio::ATENDIDO);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleordenservicio');
    }
}
