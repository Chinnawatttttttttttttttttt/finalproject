<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('NickName')->nullable();
            $table->string('Username')->unique();
            $table->string('Password');
            $table->string('Email')->unique();
            $table->string('Address');
            $table->string('Phone');
            $table->unsignedBigInteger('department_id'); // renamed for consistency
            $table->unsignedBigInteger('position_id'); // renamed for consistency
            $table->string('image_Profile')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['position_id']);
        });
        Schema::dropIfExists('users');
    }
}
