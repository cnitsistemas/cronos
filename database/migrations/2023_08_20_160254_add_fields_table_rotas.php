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
        Schema::table('rotas', function (Blueprint $table) {
            $table->text('tipo')->nullable();
            $table->text('escolas')->nullable();
            $table->text('quantidade_alunos')->nullable();
            $table->text('quantidade_dias_mes')->nullable();
            $table->text('quantidade_km')->nullable();
            $table->integer('ativo', false, true)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rotas', function (Blueprint $table) {
            //
        });
    }
};
