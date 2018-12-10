<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aula_experimental', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');
            $table->string('celular')->nallable();
            $table->string('email')->nallable();
            $table->string('idade')->nallable();
            $table->string('categoria')->nallable();

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
        Schema::dropIfExists('aula_experimental');
    }
}
