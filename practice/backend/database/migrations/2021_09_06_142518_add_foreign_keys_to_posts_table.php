<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('category_id', 'FK_852f266adc5d67c40405c887b49')->references('id')->on('post_categories')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('user_id', 'FK_c4f9a7bd77b489e711277ee5986')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('FK_852f266adc5d67c40405c887b49');
            $table->dropForeign('FK_c4f9a7bd77b489e711277ee5986');
        });
    }
}
