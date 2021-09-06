<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_reports', function (Blueprint $table) {
            $table->foreign('user_id', 'FK_6014e696c442bf3d4882fde1f8b')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('target_post_id', 'FK_7eccd23f9213a242bcaae021f67')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('category_id', 'FK_f8c3b9fc18de8956857180a7df7')->references('id')->on('report_categories')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_reports', function (Blueprint $table) {
            $table->dropForeign('FK_6014e696c442bf3d4882fde1f8b');
            $table->dropForeign('FK_7eccd23f9213a242bcaae021f67');
            $table->dropForeign('FK_f8c3b9fc18de8956857180a7df7');
        });
    }
}
