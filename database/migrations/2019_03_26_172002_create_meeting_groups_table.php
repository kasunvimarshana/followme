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
            $table->timestamps();
            
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('meeting_type_id')->index()->nullable();
            $table->unsignedBigInteger('company_id')->index()->nullable();
            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->string('name')->unique()->nullable();
            $table->text('description')->nullable();
            
            $table->foreign('meeting_type_id')->references('id')->on('meeting_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meeting_groups');
    }
}
