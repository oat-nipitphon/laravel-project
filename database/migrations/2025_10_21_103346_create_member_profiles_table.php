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
        Schema::create('member_profiles', function (Blueprint $table) {
            $table->id();

            $table->string('member_code')->nullable()->unique(); // ต้องมี column ก่อนใช้ foreign key
            $table->foreign('member_code')
                ->references('member_code')
                ->on('members')
                ->onDelete('cascade');

            $table->foreignId('prefix_id')->nullable()->constrained('member_profile_prefixes')->onDelete('cascade'); // delete prefix set default null
            $table->string('frist_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nick_name')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_profiles');
    }
};
