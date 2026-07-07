<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support ALTER COLUMN. Placement is handled in PHP (defaults to '' if null).
    }

    public function down(): void
    {
        //
    }
};
