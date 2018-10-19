<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRifaItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rifa_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rifa_id')->reference('id')->on('rifas')->onDelete('cascade');
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
        Schema::dropIfExists('rifa_items');
    }
}
