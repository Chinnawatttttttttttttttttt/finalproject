<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveVisitorCountFromNewsVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_visitors', function (Blueprint $table) {
            $table->dropColumn('visitor_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_visitors', function (Blueprint $table) {
            $table->integer('visitor_count')->default(0);
        });
    }
}
