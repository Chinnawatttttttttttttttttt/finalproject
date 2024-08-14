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
        Schema::table('elderlies', function (Blueprint $table) {
            $table->string('Title')->after('id'); // เพิ่มคอลัมน์ Title
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('elderlies', function (Blueprint $table) {
            $table->dropColumn('Title'); // ลบคอลัมน์ Title
        });
    }
};
