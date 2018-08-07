<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('gateway', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::create('status_venda', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::create('status_pag_seguro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        Schema::create('vendas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('pessoa_id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');

            $table->unsignedInteger('gateway_id');
            $table->foreign('gateway_id')->references('id')->on('gateway');

            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status_venda');

            $table->integer('tipo')->nullable();
            $table->integer('referencia')->nullable();
            $table->float('valor', 12, 2)->nullable();

            $table->integer('meio_pagamento_tipo_id')->nullable();
            $table->integer('meio_pagamento_id')->nullable();

            $table->timestamps();
        });

        Schema::create('vendas_pag_seguro', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('venda_id');
            $table->foreign('venda_id')->references('id')->on('vendas');

            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('status_pag_seguro');
            $table->string('codigo')->nullable();
            $table->datetime('data');
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
        Schema::dropIfExists('vendas_pag_seguro');
        Schema::dropIfExists('gateway');
        Schema::dropIfExists('vendas');
    }
}
