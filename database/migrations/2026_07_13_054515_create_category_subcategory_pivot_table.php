<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_subcategory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subcategory_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['category_id', 'subcategory_id']);
        });

        // Migrate existing data from subcategories.category_id to pivot table
        $subcategories = DB::table('subcategories')->select('id', 'category_id')->get();
        foreach ($subcategories as $sub) {
            DB::table('category_subcategory')->insert([
                'category_id' => $sub->category_id,
                'subcategory_id' => $sub->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('category_subcategory');
    }
};
