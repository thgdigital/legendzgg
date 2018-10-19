<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jogador_id')->reference('id')->on('jogadors')->onDelete('cascade');
            $table->string("cep");
            $table->string("endereco");
            $table->string("bairro");
            $table->string("cidade");
            $table->string("estado");
            $table->enum('typePedido', [1,2,3, 4]);
            $table->float("valor_total");
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
        Schema::dropIfExists('order_pedidos');
    }
}
