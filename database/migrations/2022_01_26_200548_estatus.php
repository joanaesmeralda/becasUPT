<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Estatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estatus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_beca');
            $table->string('estatus');
            $table->unsignedBigInteger('matricula');
            $table->timestamps();

            $table->foreign('matricula')->references('matricula')->on('alumnos');
            $table->foreign('id_beca')->references('id')->on('beca');
            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estatus');
    }
}
