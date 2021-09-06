<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('group_members', function (Blueprint $table) {
            $table->foreign('user_id', 'FK_20a555b299f75843aa53ff8b0ee')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('group_id', 'FK_2c840df5db52dc6b4a1b0b69c6e')->references('id')->on('groups')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_members', function (Blueprint $table) {
            $table->dropForeign('FK_20a555b299f75843aa53ff8b0ee');
            $table->dropForeign('FK_2c840df5db52dc6b4a1b0b69c6e');
        });
    }
}
