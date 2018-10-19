<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suportes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('topico',[1,2,3,4]);
            $table->string('outro')->nullable();
            $table->enum('status', [1,2,3]);
            $table->text("detalhe");
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
        Schema::dropIfExists('suportes');
    }
}
