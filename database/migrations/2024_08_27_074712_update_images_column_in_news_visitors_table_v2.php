<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImagesColumnInNewsVisitorsTableV2 extends Migration
{
    public function up()
    {
        Schema::table('news_visitors', function (Blueprint $table) {
            $table->longText('images')->change(); // เปลี่ยนเป็น longText
        });
    }

    public function down()
    {
        Schema::table('news_visitors', function (Blueprint $table) {
            $table->text('images')->change(); // คืนค่ากลับเป็น text
        });
    }
}
