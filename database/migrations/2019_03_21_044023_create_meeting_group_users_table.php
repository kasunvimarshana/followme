<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingGroupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_group_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meeting_group');
            $table->bigInteger('user');
            $table->timestamps();
            
            $table->foreign('meeting_group')->references('id')->on('meeting_groups')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meeting_group_users');
    }
}
