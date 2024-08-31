<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsVisitorsTable extends Migration
{
    public function up()
    {
        Schema::create('news_visitors', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // หัวข้อข่าวสาร
            $table->text('content'); // เนื้อหาข่าวสาร
            $table->integer('visitor_count')->default(0); // จำนวนการเข้าชม
            $table->timestamps(); // timestamps สำหรับ created_at และ updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('news_visitors');
    }
}
