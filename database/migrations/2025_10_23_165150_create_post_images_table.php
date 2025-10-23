<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_images', function (Blueprint $table) {
            $table->id();

            $table->string('post_code')->nullable()->unique();
            $table->foreign('post_code')->references('post_code')->on('posts')->onDelete('cascade');

            $table->string('image_name')->nullable(); // generate username - dd/mm/yyyy - hh:mm:ss
            $table->string('image_path')->nullable();
            $table->string('image_url')->nullable();

            $table->foreignId('file_type_id')->nullable()->constrained('file_types')->onDelete('cascade');

            $table->timestamps();
        });
        // DB::statement('ALTER TABLE post_images ADD image_data MEDIUMBLOB NULL');
        DB::statement('ALTER TABLE post_images ADD COLUMN image_data MEDIUMBLOB NULL AFTER image_url');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_images');
    }
};
