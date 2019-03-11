<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropagandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propagandas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome');

            $table->integer('modelo_id')->unsigned()->index();
            $table->foreign('modelo_id')->references('id')->on('modelos');
            $table->text('conteudo')->nullable();
            $table->string('boolean')->default(true);

            $table->uuid('uuid');

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
        Schema::dropIfExists('propagandas');
    }
}
