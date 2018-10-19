<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJogadorRifaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_jogador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numeber');
            $table->integer('jogador_id')->reference('id')->on('jogadors')->onDelete('cascade');
            $table->integer('items_id')->reference('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('items_jogador');
    }
}
