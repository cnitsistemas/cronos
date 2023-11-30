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
        Schema::create('paradas', function (Blueprint $table) {
            $table->id('id');
            $table->text('descricao');
            $table->unsignedBigInteger('rota_id');
            $table->unsignedBigInteger('aluno_id');
            $table->timestamps();
            $table->foreign('rota_id')->references('id')->on('rotas');
            $table->foreign('aluno_id')->references('id')->on('alunos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paradas');
    }
};
