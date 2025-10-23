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
        Schema::create('post_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable()->unique();
            $table->string('label_en')->nullable();
            $table->string('label_th')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE post_statuses ADD COLUMN image_data MEDIUMBLOB NULL AFTER label_th');
        DB::table('post_statuses')->insert([
            [
                'id' => 1,
                'code' => '200',
                'label_en' => 'enable',
                'label_th' => 'เปิดใช้งาน'
            ],
            [
                'id' => 2,
                'code' => '400',
                'label_en' => 'disable',
                'label_th' => 'ปิดใช้งาน'
            ],
            [
                'id' => 3,
                'code' => '500',
                'label_en' => 'ban',
                'label_th' => 'ระงับ'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_statuses');
    }
};
