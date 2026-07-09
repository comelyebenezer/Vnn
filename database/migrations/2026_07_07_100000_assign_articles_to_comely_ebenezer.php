<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Create or find the Comely Ebenezer user
        $user = DB::table('users')->where('email', 'comely@vnn.ng')->first();

        if (!$user) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Comely Ebenezer',
                'email' => 'comely@vnn.ng',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'status' => 'active',
                'designation' => 'Author',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $userId = $user->id;
        }

        // Create Author profile for Comely Ebenezer
        $authorExists = DB::table('authors')->where('user_id', $userId)->first();
        if (!$authorExists) {
            DB::table('authors')->insert([
                'user_id' => $userId,
                'bio' => 'Senior journalist and editor at Verve News Network, covering politics, business, and breaking news across Nigeria and Africa.',
                'expertise' => 'Investigative Journalism, Political Analysis, Business Reporting',
                'is_featured' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Assign all articles to Comely Ebenezer
        DB::table('articles')->update([
            'user_id' => $userId,
            'editor_id' => $userId,
            'publisher_id' => $userId,
        ]);
    }

    public function down(): void
    {
        // No rollback needed - this is a data migration
    }
};
