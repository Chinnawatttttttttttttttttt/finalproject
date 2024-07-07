<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('score_tais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('elderly_id')->constrained()->onDelete('cascade');
            $table->integer('mobility')->nullable();
            $table->integer('confuse')->nullable();
            $table->integer('feed')->nullable();
            $table->integer('toilet')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_t_a_i_s');
    }
};
