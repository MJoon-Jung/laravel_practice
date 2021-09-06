<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reports', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->increments('id');
            $table->text('content');
            $table->unsignedTinyInteger('category_id')->nullable()->index('FK_9a3a05f8613cc49de10acd3f994');
            $table->string('user_id', 50)->nullable()->index('FK_7211729f7ceb0a68439bbfc5888');
            $table->string('target_user_id', 50)->nullable()->index('FK_cf00f5aa8187e0c92fee367e189');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_reports');
    }
}
