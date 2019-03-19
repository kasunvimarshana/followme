<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            //$table->bigIncrements('id');
            $table->bigInteger('id')->unsigned()->unique();
            $table->bigInteger('epf_no')->unsigned()->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('company_group')->unsigned();
            $table->bigInteger('department')->unsigned();
            $table->bigInteger('department_position')->unsigned()->nullable();
            $table->bigInteger('hod')->unsigned();
            $table->bigInteger('created_by')->unsigned();
            $table->string('phone');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->primary('id');
            $table->foreign('company_group')->references('id')->on('company_groups')->onDelete('cascade')->onUpdate('cascade');
            $tale->foreign('department')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('department_position')->references('id')->on('department_positions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('sys_users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hod')->references('id')->on('sys_users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sys_users');
    }
}
