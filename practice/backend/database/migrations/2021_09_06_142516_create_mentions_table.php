<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentions', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->increments('id');
            $table->enum('category', ['chat', 'dm', 'system']);
            $table->unsignedInteger('chat_id')->index('FK_0749195f3aefef1f2de555934b8');
            $table->unsignedInteger('room_id')->index('FK_d2be953b602eaaf31fd63468a3d');
            $table->string('sender_id', 50)->index('FK_45c63bf141259ee0f1a9aa47fc2');
            $table->string('receiver_id', 50)->index('FK_7f119560539ae34934d768b873a');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentions');
    }
}
