<?php
use App\Parteingreso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleparteingresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleparteingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parteingreso_id');
            $table->foreign('parteingreso_id')->references('id')->on('parteingreso');
            $table->unsignedBigInteger('producto_id')->required();
            $table->foreign('producto_id')->references('id')->on('producto');
            $table->integer('cantidad')->required();
            $table->unsignedBigInteger('unidmedida_id')->required();
            $table->foreign('unidmedida_id')->references('id')->on('unidmedida');
            $table->double('punit');
            $table->enum('estado',[Parteingreso::PENDIENTE,Parteingreso::APROBADO])->default(Parteingreso::PENDIENTE); 
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
        Schema::dropIfExists('detalleparteingreso');
    }
}
