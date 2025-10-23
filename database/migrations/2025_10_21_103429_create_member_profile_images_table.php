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
        Schema::create('member_profile_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_profile_id')->constrained('member_profiles')->onDelete('cascade');

            $table->string('name')->nullable(); // generate username - dd/mm/yyyy - hh:mm:ss
            $table->string('path')->nullable();
            $table->binary('data')->nullable();
            $table->string('url')->nullable();

            $table->foreignId('file_type_id')->nullable()->constrained('file_types')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_images');
    }
};
