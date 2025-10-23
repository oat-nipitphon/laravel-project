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
        Schema::create('member_profile_prefixes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // mr , miss
            $table->string('label_en')->nullable(); // Mr. , Miss.
            $table->string('label_th')->nullable(); // นาย , นางสาว
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prefixes');
    }
};
