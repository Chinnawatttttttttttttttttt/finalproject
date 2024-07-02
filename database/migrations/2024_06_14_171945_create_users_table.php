<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
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
            $table->bigInteger('DPT_id')->unsigned();
            $table->string('department_name'); // เปลี่ยนเป็น department_name
            $table->bigInteger('PT_id')->unsigned();
            $table->string('position_name'); // เปลี่ยนเป็น position_name
            $table->string('image_Profile')->nullable();
            $table->timestamps();

            // สร้าง Foreign Key ไปยังตาราง departments
            $table->foreign('DPT_id')->references('id')->on('departments')->onDelete('cascade');

            // สร้าง Foreign Key ไปยังตาราง positions
            $table->foreign('PT_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
