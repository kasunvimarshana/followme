<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingTwsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_tws', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meeting');
            $table->text('description');
            $table->boolean('is_done')->default(0);
            $table->string('status')->default('0');
            $table->dateTime('due_date')->useCurrent();
            $table->bigInteger('done_by')->nullable();
            $table->timestamps();
            
            $table->foreign('meeting')->references('id')->on('meetings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('done_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_tws');
    }
}
