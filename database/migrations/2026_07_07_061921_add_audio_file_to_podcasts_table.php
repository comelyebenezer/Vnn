<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('audio_file')->nullable()->after('audio_url');
            $table->string('audio_type')->nullable()->after('audio_file');
        });
    }

    public function down(): void
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->dropColumn(['audio_file', 'audio_type']);
        });
    }
};
