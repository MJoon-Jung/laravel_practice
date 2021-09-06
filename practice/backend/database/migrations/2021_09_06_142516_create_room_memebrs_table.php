<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomMemebrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_memebrs', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->unsignedInteger('room_id');
            $table->string('user_id', 50)->index('FK_2af0ce9ea8513d87327c971f524');
            $table->primary(['room_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_memebrs');
    }
}
