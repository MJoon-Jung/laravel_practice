<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentions', function (Blueprint $table) {
            $table->foreign('chat_id', 'FK_0749195f3aefef1f2de555934b8')->references('id')->on('room_chats')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('sender_id', 'FK_45c63bf141259ee0f1a9aa47fc2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('receiver_id', 'FK_7f119560539ae34934d768b873a')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('room_id', 'FK_d2be953b602eaaf31fd63468a3d')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentions', function (Blueprint $table) {
            $table->dropForeign('FK_0749195f3aefef1f2de555934b8');
            $table->dropForeign('FK_45c63bf141259ee0f1a9aa47fc2');
            $table->dropForeign('FK_7f119560539ae34934d768b873a');
            $table->dropForeign('FK_d2be953b602eaaf31fd63468a3d');
        });
    }
}
