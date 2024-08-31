<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsAndLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits_and_logins', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address'); // บันทึก IP Address ของผู้เข้าชม
            $table->timestamp('visited_at')->useCurrent(); // บันทึกเวลาการเข้าชม
            $table->boolean('is_login')->default(false); // บันทึกว่ามีการเข้าสู่ระบบหรือไม่
            $table->unsignedBigInteger('user_id')->nullable(); // บันทึก user ID หากมีการเข้าสู่ระบบ
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // ตั้งค่าความสัมพันธ์กับตาราง users
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits_and_logins');
    }
}
