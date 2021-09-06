<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('post_id', 'FK_259bf9825d9d198608d1b46b0b5')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('user_id', 'FK_4c675567d2a58f0b07cef09c13d')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('parent_id', 'FK_d6f93329801a93536da4241e386')->references('id')->on('comments')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('FK_259bf9825d9d198608d1b46b0b5');
            $table->dropForeign('FK_4c675567d2a58f0b07cef09c13d');
            $table->dropForeign('FK_d6f93329801a93536da4241e386');
        });
    }
}
