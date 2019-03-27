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
            $table->timestamps();
            
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('meeting_type_id')->index()->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->dateTime('start_date');
            $table->dateTime('start_time');
            $table->dateTime('end_date');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('company_id')->index()->nullable();
            $table->unsignedBigInteger('company_location_id')->index()->nullable();
            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->string('status')->default('0');
            $table->integer('piority')->default(0);
            
            $table->foreign('meeting_type_id')->references('id')->on('meeting_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_location_id')->references('id')->on('company_locations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
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
