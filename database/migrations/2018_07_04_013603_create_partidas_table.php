<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('torneio_id');
            $table->unsignedInteger('quadra_id');

            $table->foreign('torneio_id')->references('id')->on('torneios');
            $table->foreign('quadra_id')->references('id')->on('quadras');

            $table->datetime('inicio')->nullable();
            $table->datetime('fim')->nullable();

            $table->enum('tipo_jogo', ['Simples', 'Duplas'])->default('Simples');
            $table->string('semana')->nullable();

            $table->integer('jogador1_id')->nullable();
            $table->integer('jogador2_id')->nullable();

            $table->smallInteger('jogador1_resultado_final')->default(0);
            $table->smallInteger('jogador1_set1')->default(0);
            $table->smallInteger('jogador1_set2')->default(0);
            $table->smallInteger('jogador1_set3')->default(0);
            $table->boolean('jogador1_tiebreak')->default(false);
            $table->boolean('jogador1_vitoria_wo')->default(false);
            $table->boolean('jogador1_desistencia')->default(false);
            $table->integer('jogador1_pontos')->default(0);
            $table->integer('jogador1_bonus')->default(0);
            $table->boolean('jogador1_computado')->default(true);

            $table->smallInteger('jogador2_resultado_final')->default(0);
            $table->smallInteger('jogador2_set1')->default(0);
            $table->smallInteger('jogador2_set2')->default(0);
            $table->smallInteger('jogador2_set3')->default(0);
            $table->boolean('jogador2_tiebreak')->default(false);
            $table->boolean('jogador2_vitoria_wo')->default(false);
            $table->boolean('jogador2_desistencia')->default(false);
            $table->integer('jogador2_pontos')->default(0);
            $table->integer('jogador2_bonus')->default(0);
            $table->boolean('jogador2_computado')->default(true);

            $table->boolean('ativo')->default(true);
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
        Schema::dropIfExists('partidas');
    }
}
