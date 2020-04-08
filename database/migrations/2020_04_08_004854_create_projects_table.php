<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->string('name');
            $table->string('code');
            $table->string('client');
            $table->string('franchise');
            $table->string('status')->default('active');
            $table->string('quote')->nullable();
            $table->rememberToken();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
