<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('meeting_type')->nullable();
            $table->bigInteger('company')->nullable();
            $table->bigInteger('department')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->foreign('meeting_type')->references('id')->on('meeting_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meeting_groups');
    }
}
