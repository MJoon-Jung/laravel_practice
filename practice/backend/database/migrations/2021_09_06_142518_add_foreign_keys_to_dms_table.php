<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dms', function (Blueprint $table) {
            $table->foreign('room_id', 'FK_22e7ef74bfa3013d9f5d3e90e52')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('sender_id', 'FK_3f3092a3edc10429f64ba43b37c')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('receiver_id', 'FK_667a5fcf57043e3205907d6ee88')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dms', function (Blueprint $table) {
            $table->dropForeign('FK_22e7ef74bfa3013d9f5d3e90e52');
            $table->dropForeign('FK_3f3092a3edc10429f64ba43b37c');
            $table->dropForeign('FK_667a5fcf57043e3205907d6ee88');
        });
    }
}
