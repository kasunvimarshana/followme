<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('meeting_type');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->dateTime('start_date');
            $table->dateTime('start_time');
            $table->dateTime('end_date');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('company')->nullable();
            $table->unsignedBigInteger('company_location')->nullable();
            $table->unsignedBigInteger('department')->nullable();
            $table->string('status')->default('0');
            $table->integer('piority')->default(0);
            $table->timestamps();
            
            $table->foreign('meeting_type')->references('id')->on('meeting_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_location')->references('id')->on('company_locations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
