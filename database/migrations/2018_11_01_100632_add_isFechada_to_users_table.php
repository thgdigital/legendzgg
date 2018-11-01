<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsFechadaToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rifas', function (Blueprint $table) {
            //
            $table->boolean('is_fechada', 0)->after('date_fim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rifas', function (Blueprint $table) {
            //
            $table->dropColumn("is_fechada");
        });
    }
}
