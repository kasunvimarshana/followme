<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //default fields
            //$table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            //custom fields
            //$table->bigInteger('id')->unsigned()->unique();
            $table->unsignedBigInteger('id')->unique();
            $table->unsignedBigInteger('epf_no')->unique();
            $table->unsignedBigInteger('company')->nullable();
            $table->unsignedBigInteger('department')->nullable();
            $table->unsignedBigInteger('user_position')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('phone');
            //$table->boolean('active')->default(0);
            //$table->enum('status', ['a', 'd']);
            $table->string('status')->default('1');
            
            //$table->primary('id');
            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_position')->references('id')->on('user_positions')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            //$table->index('epf_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}