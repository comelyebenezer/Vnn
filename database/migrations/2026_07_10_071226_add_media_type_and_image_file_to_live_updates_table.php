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
        Schema::table('live_updates', function (Blueprint $table) {
            $table->string('media_type')->default('video')->after('title');
            $table->string('image_file')->nullable()->after('video_file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('live_updates', function (Blueprint $table) {
            $table->dropColumn(['media_type', 'image_file']);
        });
    }
};
