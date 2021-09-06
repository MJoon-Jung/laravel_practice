<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostLikeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_like', function (Blueprint $table) {
            $table->foreign('post_id', 'FK_a7ec6ac3dc7a05a9648c418f1ad')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'FK_c635b15915984c8cdb520a1fef3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_like', function (Blueprint $table) {
            $table->dropForeign('FK_a7ec6ac3dc7a05a9648c418f1ad');
            $table->dropForeign('FK_c635b15915984c8cdb520a1fef3');
        });
    }
}
