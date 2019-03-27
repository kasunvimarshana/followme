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
            $table->unsignedBigInteger('id')->unique()->index();
            $table->unsignedBigInteger('epf_no')->unique();
            $table->unsignedBigInteger('company_id')->index()->nullable();
            $table->unsignedBigInteger('department_id')->index()->nullable();
            $table->unsignedBigInteger('user_position_id')->index()->nullable();
            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->string('phone')->nullable();
            $table->boolean('active')->default(1);
            //$table->enum('status', ['a', 'd']);
            $table->string('status')->default('0')->nullable();
            
            $table->primary('id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_position_id')->references('id')->on('user_positions')->onDelete('cascade')->onUpdate('cascade');
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