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
        Schema::create('condutores', function (Blueprint $table) {
            $table->id('id');
            $table->text('nome');
            $table->text('tipo_habilitacao');
            $table->text('categoria_habilitacao');
            $table->text('identificador_documento_habilitacao');
            $table->text('validade_habilitacao');
            $table->text('idade');
            $table->text('cep');
            $table->text('endereco');
            $table->text('cidade');
            $table->integer('ativo', false, true);
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
        Schema::drop('condutores');
    }
};
