<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRespostasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('resposta');
            $table->integer('suporte_id')->nullable()->unsigned();
            $table->foreign('suporte_id')->references('id')->on('suportes');
            $table->integer('admin_id')->nullable()->unsigned();
            $table->foreign('admin_id')->references('id')->on('users');
            $table->integer('jogador_id')->nullable()->unsigned();
            $table->foreign('jogador_id')->references('id')->on('users');
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
        Schema::dropIfExists('respostas');
    }
}
