<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->nullable();
            $table->string('nombres',200)->required();
            $table->string('ApPaterno',200)->nullable();
            $table->string('ApMaterno',200)->nullable();
            $table->string('DNI',11)->nullable()->unique();
            $table->unsignedBigInteger('zonal_id');
            $table->foreign('cargo_personal_id')->references('id')->on('cargo_personal');
            $table->unsignedBigInteger('cargo_personal_id');
            $table->foreign('zonal_id')->references('id')->on('zonal');
            $table->char('estado',1)->required();
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
        Schema::dropIfExists('personal');
    }
}
