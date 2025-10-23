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
        Schema::create('post_types', function (Blueprint $table) {
            $table->id();
            $table->string('post_type_code')->nullable()->unique();
            $table->string('label_en')->nullable();
            $table->string('label_th')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE post_types ADD COLUMN image_data MEDIUMBLOB NULL AFTER label_th');
         DB::table('post_types')->insert([
            [
                'id' => 1,
                'post_type_code' => 'laravel-0001',
                'label_en' => 'laravel'
            ],
            [
                'id' => 2,
                'post_type_code' => 'vue-0002',
                'label_en' => 'vue'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_types');
    }
};
