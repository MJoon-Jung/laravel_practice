<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->string('id', 50)->primary();
            $table->string('email', 50)->unique('IDX_97672ac88f789774dd47f7c8be');
            $table->string('nickname', 20)->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->unsignedInteger('major')->nullable()->index('FK_36140e591dbea83bac5b2f8fa7d');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
