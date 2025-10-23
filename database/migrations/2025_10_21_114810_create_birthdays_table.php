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
        Schema::create('birthdays', function (Blueprint $table) {
            $table->id();

            $table->string('member_code')->nullable()->unique(); // ต้องมี column ก่อนใช้ foreign key
            $table->foreign('member_code')
                ->references('member_code')
                ->on('members')
                ->onDelete('cascade');

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
