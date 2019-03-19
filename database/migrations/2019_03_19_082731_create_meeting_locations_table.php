<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('company_group')->unsigned();
            $table->bigInteger('department')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('sys_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('sys_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_locations');
    }
}
