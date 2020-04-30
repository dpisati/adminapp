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
            $table->integer('picture')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('measure_type');
            $table->string('type');
            $table->integer('min_width')->nullable();
            $table->integer('max_width')->nullable();
            $table->integer('min_height')->nullable();
            $table->integer('max_height')->nullable();
            $table->integer('min_depth')->nullable();
            $table->integer('max_depth')->nullable();
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
