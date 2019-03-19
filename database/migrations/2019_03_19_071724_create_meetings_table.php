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
            $table->bigInteger('created_by')->unsigned();
            $table->string('title');
            $table->text('description')->nullable();
            //$table->dateTime('due_date')->useCurrent();
            $table->dateTime('due_date');
            $table->dateTime('due_time');
            //$table->decimal('duration', 4, 2)->nullable();
            $table->float('duration')->nullable();
            $table->bigInteger('company_group')->unsigned();
            $table->bigInteger('department')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('meetings');
    }
}
