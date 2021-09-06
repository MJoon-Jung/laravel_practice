<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_reports', function (Blueprint $table) {
            $table->foreign('user_id', 'FK_7211729f7ceb0a68439bbfc5888')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('category_id', 'FK_9a3a05f8613cc49de10acd3f994')->references('id')->on('report_categories')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('target_user_id', 'FK_cf00f5aa8187e0c92fee367e189')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_reports', function (Blueprint $table) {
            $table->dropForeign('FK_7211729f7ceb0a68439bbfc5888');
            $table->dropForeign('FK_9a3a05f8613cc49de10acd3f994');
            $table->dropForeign('FK_cf00f5aa8187e0c92fee367e189');
        });
    }
}
