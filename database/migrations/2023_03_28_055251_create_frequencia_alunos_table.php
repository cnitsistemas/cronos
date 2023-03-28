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
        Schema::create('frequencia_alunos', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('frequencia_id');
            $table->integer('presenca');
            $table->timestamps();
            $table->foreign('aluno_id')->references('id')->on('alunos')->onDelete('restrict');
            $table->foreign('frequencia_id')->references('id')->on('frequencias')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('frequencia_alunos');
    }
};
