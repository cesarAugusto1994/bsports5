<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMidiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('midias', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', ['imagem','video','link']);
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::create('midia_links', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('midia_id');
            $table->foreign('midia_id')->references('id')->on('midias');
            $table->string('link');
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
        Schema::dropIfExists('midias');
    }
}
