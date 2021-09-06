<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comment_like', function (Blueprint $table) {
            $table->foreign('comment_id', 'FK_4a0c128374ff87d4641cab920f0')->references('id')->on('comments')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'FK_fd7207639a77fa0f1fea8943b78')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment_like', function (Blueprint $table) {
            $table->dropForeign('FK_4a0c128374ff87d4641cab920f0');
            $table->dropForeign('FK_fd7207639a77fa0f1fea8943b78');
        });
    }
}
