<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabinetRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabinet_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cabinet_id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('width');
            $table->unsignedBigInteger('height');
            $table->unsignedBigInteger('depth');
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('cabinet_id')
                ->references('id')
                ->on('cabinets')        
                ->onDelete('cascade');        

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')        
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabinet_room');
    }
}
