<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ItemsLoja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('items_loja', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('loja_id')->reference('id')->on('lojas')->onDelete('cascade');
            $table->unsignedInteger('item_id')->reference('id')->on('items')->onDelete('cascade');
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
        Schema::dropIfExists('items_loja');
    }
}
