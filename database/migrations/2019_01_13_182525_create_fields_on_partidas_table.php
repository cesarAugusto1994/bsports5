<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsOnPartidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partidas', function (Blueprint $table) {
            $table->enum('status', ['Pendente','Em Andamento', 'Finalizada', 'Cancelada', 'WO'])->default('Pendente')->after('jogador2_computado');
            $table->integer('usuario_criacao_id')->nullable()->after('status');
            $table->integer('usuario_finalizacao_id')->nullable()->after('usuario_criacao_id');
            $table->integer('semestre_id')->nullable()->after('usuario_finalizacao_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partidas', function (Blueprint $table) {
            $table->dropColumn('semestre_id');
            $table->dropColumn('usuario_finalizacao_id');
            $table->dropColumn('usuario_criacao_id');
            $table->dropColumn('status');
        });
    }
}
