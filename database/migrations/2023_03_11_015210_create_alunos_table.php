<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id('id');
            $table->text('nome');
            $table->text('serie');
            $table->text('ensino');
            $table->text('turno');
            $table->text('nome_escola');
            $table->unsignedBigInteger('rota_id');
            $table->text('cep')->nullable();
            $table->text('endereco')->nullable();
            $table->text('bairro')->nullable();
            $table->text('numero')->nullable();
            $table->text('complemento')->nullable();
            $table->text('cidade')->nullable();
            $table->text('estado')->nullable();
            $table->timestamps();
            $table->foreign('rota_id')->references('id')->on('rotas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alunos');
    }
};
