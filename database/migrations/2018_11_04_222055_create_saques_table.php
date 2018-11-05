<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saques', function (Blueprint $table) {
            $table->increments('id');
            $table->double('saque');
            $table->integer("jogador_id")->reference('id')->on('jogadors')->onDelete('cascade');
            $table->integer("admin_id")->reference('id')->on('users')->onDelete('cascade')->nullable();
            $table->boolean('status');
            $table->enum('type',['1', '2']);
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
        Schema::dropIfExists('saques');
    }
}
