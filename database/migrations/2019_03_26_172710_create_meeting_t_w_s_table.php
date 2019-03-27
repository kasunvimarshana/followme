<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingTWSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_t_w_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('meeting_id')->index()->nullable();
            $table->text('description');
            $table->boolean('is_done')->default(0);
            $table->string('status')->default('0');
            $table->dateTime('due_date')->nullable()->useCurrent();
            $table->unsignedBigInteger('done_by')->index()->nullable();
            $table->dateTime('done_date')->nullable()->useCurrent();
            $table->integer('piority')->default(0);
            
            $table->foreign('meeting_id')->references('id')->on('meetings')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meeting_t_w_s');
    }
}
