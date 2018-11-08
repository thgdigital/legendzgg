<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUsernameToInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            //
            $table->dropColumn('username');
            $table->text('invocador')->after('is_liberado')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            //
            $table->dropColumn('invocador');
            $table->string('username')->nullable();
        });
    }
}
