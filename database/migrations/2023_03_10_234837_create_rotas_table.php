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
        Schema::create('rotas', function (Blueprint $table) {
            $table->id('id');
            $table->text('nome');
            $table->text('hora_ida_inicio')->nullable();
            $table->text('hora_ida_termino')->nullable();
            $table->integer('da_porteira', false, true)->nullable();
            $table->integer('da_mataburro', false, true)->nullable();
            $table->integer('da_atoleiro', false, true)->nullable();
            $table->integer('da_colchete', false, true)->nullable();
            $table->integer('turno_matutino', false, true)->nullable();
            $table->integer('turno_vespertino', false, true)->nullable();
            $table->integer('turno_noturno', false, true)->nullable();
            $table->text('hora_volta_inicio')->nullable();
            $table->text('hora_volta_termino')->nullable();
            $table->text('latitude_inicio');
            $table->text('longitude_inicio');
            $table->text('latitude_termino');
            $table->text('longitude_termino');
            $table->text('tempo')->nullable();
            $table->timestamps();
        });
    }

    /**
     *
     *
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rotas');
    }
};
