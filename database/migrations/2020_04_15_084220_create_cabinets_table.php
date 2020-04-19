<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('cabinet_id');
            $table->string('name');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('width');
            $table->unsignedBigInteger('height');
            $table->unsignedBigInteger('depth');
            $table->string('comment')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('cabinets');
    }
}
