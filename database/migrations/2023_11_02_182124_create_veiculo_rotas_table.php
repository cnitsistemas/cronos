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
        Schema::create('veiculo_rotas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('rota_id');
            $table->unsignedBigInteger('veiculo_id');
            $table->integer('active', false, true);
            $table->timestamps();
            $table->foreign('rota_id')->references('id')->on('rotas');
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('veiculo_rotas');
    }
};
