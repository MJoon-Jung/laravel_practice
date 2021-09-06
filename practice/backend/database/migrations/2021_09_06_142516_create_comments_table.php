<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->increments('id');
            $table->text('comment');
            $table->string('user_id', 50)->nullable()->index('FK_4c675567d2a58f0b07cef09c13d');
            $table->unsignedInteger('post_id')->nullable()->index('FK_259bf9825d9d198608d1b46b0b5');
            $table->unsignedInteger('parent_id')->nullable()->index('FK_d6f93329801a93536da4241e386');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
