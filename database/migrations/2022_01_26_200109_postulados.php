<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Postulados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idbeca');
            $table->unsignedBigInteger('matricula');
            $table->timestamps();

            $table->foreign('matricula')->references('matricula')->on('alumnos');
            $table->foreign('idbeca')->references('id')->on('beca');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postulados');
    }
}
