<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('live_updates', function (Blueprint $table) {
            $table->string('video_type')->nullable()->default('youtube')->change();
        });
    }

    public function down(): void
    {
        Schema::table('live_updates', function (Blueprint $table) {
            $table->string('video_type')->default('youtube')->change();
        });
    }
};
