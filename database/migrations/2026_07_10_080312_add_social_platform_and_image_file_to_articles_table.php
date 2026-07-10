<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('social_platform')->nullable()->after('media_type');
            $table->string('media_content_type')->nullable()->after('social_platform');
            $table->string('image_file')->nullable()->after('media_content_type');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['social_platform', 'media_content_type', 'image_file']);
        });
    }
};
