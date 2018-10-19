<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('card_credits', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("cpf");
            $table->string("number");
            $table->string("validade");
            $table->string("cvv");
            $table->string("bandeira");
            $table->integer('jogador_id')->reference('id')->on('jogadors')->onDelete('cascade');
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
        Schema::dropIfExists('card_credits');
    }
}
