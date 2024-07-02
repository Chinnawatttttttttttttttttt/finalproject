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
        Schema::create('elderlies', function (Blueprint $table) {
            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('NickName')->nullable();
            $table->date('Birthday');
            $table->integer('Age');
            $table->string('Address');
            $table->decimal('Latitude', 10, 7);  // ความแม่นยำถึงทศนิยม 7 ตำแหน่ง
            $table->decimal('Longitude', 10, 7); // ความแม่นยำถึงทศนิยม 7 ตำแหน่ง
            $table->string('Phone');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elderlies');
    }
};
