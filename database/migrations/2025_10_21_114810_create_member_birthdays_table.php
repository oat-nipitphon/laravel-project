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
        Schema::create('member_birthdays', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_profile_id')->constrained('member_profiles')->onDelete('cascade')->unique();

            $table->year('birth_year');
            $table->tinyInteger('birth_month');
            $table->tinyInteger('birth_day');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birthdays');
    }
};
