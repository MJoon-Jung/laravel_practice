<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlacklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blacklists', function (Blueprint $table) {
            $table->foreign('blackUser_id', 'FK_ebbcfcaf833f2a4c56c2e755878')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'FK_f7e6ae3724502b191d335180cfe')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blacklists', function (Blueprint $table) {
            $table->dropForeign('FK_ebbcfcaf833f2a4c56c2e755878');
            $table->dropForeign('FK_f7e6ae3724502b191d335180cfe');
        });
    }
}
