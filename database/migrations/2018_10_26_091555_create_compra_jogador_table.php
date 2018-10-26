<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraJogadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('jogador_loja', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loja_id')->reference('id')->on('lojas')->onDelete('cascade');
            $table->unsignedInteger('jogador_id')->reference('id')->on('jogadors')->onDelete('cascade');
            $table->boolean('valor_credito');
            $table->boolean('valor_resgate');
            $table->boolean('valor_essencia');
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
        //
    }
}
