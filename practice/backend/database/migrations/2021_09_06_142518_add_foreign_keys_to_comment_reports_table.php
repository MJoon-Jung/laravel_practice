<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCommentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comment_reports', function (Blueprint $table) {
            $table->foreign('target_comment_id', 'FK_125c9bde561d292724d4ee10eec')->references('id')->on('comments')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('category_id', 'FK_5f08c2b0bd88fa1a29485f4d48a')->references('id')->on('report_categories')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('user_id', 'FK_bc1731e1299bae0acc22cc3c956')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comment_reports', function (Blueprint $table) {
            $table->dropForeign('FK_125c9bde561d292724d4ee10eec');
            $table->dropForeign('FK_5f08c2b0bd88fa1a29485f4d48a');
            $table->dropForeign('FK_bc1731e1299bae0acc22cc3c956');
        });
    }
}
