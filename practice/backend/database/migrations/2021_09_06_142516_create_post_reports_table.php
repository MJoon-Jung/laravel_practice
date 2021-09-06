<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_reports', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->increments('id');
            $table->string('content');
            $table->unsignedTinyInteger('category_id')->nullable()->index('FK_f8c3b9fc18de8956857180a7df7');
            $table->string('user_id', 50)->nullable()->index('FK_6014e696c442bf3d4882fde1f8b');
            $table->unsignedInteger('target_post_id')->nullable()->index('FK_7eccd23f9213a242bcaae021f67');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_reports');
    }
}
