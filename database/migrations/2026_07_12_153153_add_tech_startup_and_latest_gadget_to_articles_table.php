<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_tech_startup')->default(false)->after('is_editor_pick');
            $table->boolean('is_latest_gadget')->default(false)->after('is_tech_startup');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['is_tech_startup', 'is_latest_gadget']);
        });
    }
};
