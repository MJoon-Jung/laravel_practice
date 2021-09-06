<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRoomMemebrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room_memebrs', function (Blueprint $table) {
            $table->foreign('user_id', 'FK_2af0ce9ea8513d87327c971f524')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('room_id', 'FK_31bf4f44cbf71adbacbb076cfd4')->references('id')->on('rooms')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room_memebrs', function (Blueprint $table) {
            $table->dropForeign('FK_2af0ce9ea8513d87327c971f524');
            $table->dropForeign('FK_31bf4f44cbf71adbacbb076cfd4');
        });
    }
}
