<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishMaterial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish_material', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('finish_id');
            $table->unsignedBigInteger('material_id');
            $table->timestamps();

            $table->foreign('finish_id')
                ->references('id')
                ->on('finishes')        
                ->onDelete('cascade');        

            $table->foreign('material_id')
                ->references('id')
                ->on('materials')        
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
        Schema::dropIfExists('finish_material');
    }
}
