<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dms', function (Blueprint $table) {
            $table->dateTime('created_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->dateTime('updated_at', 6)->default('CURRENT_TIMESTAMP(6)');
            $table->softDeletes('deleted_at', 6);
            $table->increments('id');
            $table->string('sender_id', 50)->index('FK_3f3092a3edc10429f64ba43b37c');
            $table->string('receiver_id', 50)->index('FK_667a5fcf57043e3205907d6ee88');
            $table->unsignedInteger('room_id')->index('FK_22e7ef74bfa3013d9f5d3e90e52');
            $table->text('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dms');
    }
}
