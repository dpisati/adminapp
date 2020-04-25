<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sub_category_id');
            $table->string('name');
            $table->string('measure_type');
            $table->string('type');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('depth')->nullable();
            $table->timestamps();
            
            $table->foreign('sub_category_id')
            ->references('id')
            ->on('sub_categories')
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
        Schema::dropIfExists('libraries');
    }
}
