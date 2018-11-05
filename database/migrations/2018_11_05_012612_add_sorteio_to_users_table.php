<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSorteioToUsersTable extends Migration
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
            $table->integer('sorteio')->after('is_fechada')->nullable();
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
            $table->dropColumn('sorteio');
        });
    }
}
