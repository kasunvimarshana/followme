<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTwUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tw_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meeting_tw');
            $table->bigInteger('user');
            $table->timestamps();
            
            $table->foreign('meeting_tw')->references('id')->on('meeting_tws')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tw_users');
    }
}
