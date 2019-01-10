<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogadorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->date('nascimento')->nullable();
            $table->string('email');
            $table->string('cpf')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular')->nullable();
            $table->string('lateralidade')->nullable();
            $table->integer('categoria_id')->nullable();
            $table->string('avatar')->nullable();
            $table->text('observacao')->nullable();

            $table->uuid('uuid');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
            $table->boolean('aluno')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogadores');
    }
}
