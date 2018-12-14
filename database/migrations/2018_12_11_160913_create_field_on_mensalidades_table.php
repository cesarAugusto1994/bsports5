<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldOnMensalidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mensalidades', function (Blueprint $table) {
            $table->string('gateway_referencia')->nullable();
            $table->enum('forma_pagamento', ['dinheiro', 'cartao', 'cheque', 'boleto', 'outro'])->default('dinheiro');
            $table->text('descricao')->nullable();
            $table->integer('criado_por')->nullable();
            $table->integer('recebido_por')->nullable();
            $table->datetime('data_pagamento')->nullable();
        });

        Schema::create('mensalidade_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status_anterior_id')->nullable();
            $table->string('status_atual_id');
            $table->string('mensagem')->nullable();
            $table->unsignedInteger('mensalidade_id');
            $table->foreign('mensalidade_id')->references('id')->on('mensalidades');
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
        Schema::dropIfExists('mensalidade_logs');
        Schema::table('mensalidades', function (Blueprint $table) {
            $table->dropColumn('data_pagamento');
            $table->dropColumn('forma_pagamento');
            $table->dropColumn('descricao');
            $table->dropColumn('recebido_por');
            $table->dropColumn('criado_por');
            $table->dropColumn('gateway_referencia');
        });
    }
}
