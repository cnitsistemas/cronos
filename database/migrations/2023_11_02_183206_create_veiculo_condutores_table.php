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
        Schema::create('veiculo_condutores', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('veiculo_id');
            $table->unsignedBigInteger('condutor_id');
            $table->integer('active', false, true);
            $table->timestamps();
            $table->foreign('veiculo_id')->references('id')->on('veiculos');
            $table->foreign('condutor_id')->references('id')->on('condutores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('veiculo_condutores');
    }
};
