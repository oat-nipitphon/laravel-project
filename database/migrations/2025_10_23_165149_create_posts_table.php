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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('member_profile_id')
                ->constrained('member_profiles')
                ->onDelete('cascade');

            $table->foreignId('post_status_id')
                ->constrained('post_statuses')
                ->onDelete('cascade');

            $table->string('post_type_code')->nullable();
            $table->foreign('post_type_code')
                ->references('post_type_code')
                ->on('post_types')
                ->onDelete('set null');

            $table->string('post_code')->unique();
            $table->string('title');
            $table->text('content');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
