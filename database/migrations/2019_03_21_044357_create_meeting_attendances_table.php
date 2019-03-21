<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user');
            $table->bigInteger('meeting');
            $table->boolean('is_attend')->default(0);
            $table->bigInteger('company')->nullable();
            $table->bigInteger('department')->nullable();
            $table->bigInteger('user_position')->nullable();
            $table->timestamps();
            
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('meeting')->references('id')->on('meetings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_position')->references('id')->on('user_positions')-->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_attendances');
    }
}
