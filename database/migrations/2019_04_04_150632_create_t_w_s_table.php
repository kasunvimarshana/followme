<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTWSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_w_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->boolean('is_visible')->default(1)->nullable();
            //$table->unsignedBigInteger('created_user')->index()->nullable();
            $table->string('created_user')->index()->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('meeting_category_id')->index()->nullable();
            $table->unsignedBigInteger('status_id')->default(null)->nullable();
            $table->dateTime('start_date')->nullable()->useCurrent();
            $table->dateTime('due_date')->nullable()->useCurrent();
            $table->integer('piority')->default(0)->nullable();
            $table->boolean('is_done')->default(0)->nullable();
            //$table->unsignedBigInteger('done_user')->index()->nullable();
            $table->string('done_user')->index()->nullable();
            //$table->dateTime('done_date')->nullable()->useCurrent();
            $table->dateTime('done_date')->nullable()->default(null);
            $table->text('resource_dir')->nullable()->default(null);
            $table->boolean('is_cloned')->default(0)->nullable();
            //$table->softDeletes();
            
            $table->foreign('meeting_category_id')->references('id')->on('meeting_categories')->onUpdate('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_w_s');
    }
}
