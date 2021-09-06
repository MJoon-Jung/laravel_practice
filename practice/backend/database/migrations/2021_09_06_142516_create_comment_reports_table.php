<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_reports', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->increments('id');
            $table->text('content');
            $table->unsignedTinyInteger('category_id')->nullable()->index('FK_5f08c2b0bd88fa1a29485f4d48a');
            $table->string('user_id', 50)->nullable()->index('FK_bc1731e1299bae0acc22cc3c956');
            $table->unsignedInteger('target_comment_id')->nullable()->index('FK_125c9bde561d292724d4ee10eec');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_reports');
    }
}
