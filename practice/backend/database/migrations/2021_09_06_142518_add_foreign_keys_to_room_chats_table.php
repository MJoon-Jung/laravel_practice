<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoomChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_chats', function (Blueprint $table) {
            $table->foreign('room_id', 'FK_3682aedc633a3690d81eb7dd7e4')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('user_id', 'FK_d2649270b76604d3f3afca37089')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_chats', function (Blueprint $table) {
            $table->dropForeign('FK_3682aedc633a3690d81eb7dd7e4');
            $table->dropForeign('FK_d2649270b76604d3f3afca37089');
        });
    }
}
