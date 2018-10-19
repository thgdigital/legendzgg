<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("imagem");
            $table->integer("num_rifias");
            $table->float("valor_rifa");
            $table->float("valor_venda");
            $table->float("valor_rp");
            $table->boolean("resgatavel");
            $table->boolean("status");
            $table->unsignedInteger('tipo_items_id');
            $table->foreign('tipo_items_id')->references('id')->on('tipo_items')
                ->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
