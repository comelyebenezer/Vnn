<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'News', 'slug' => 'news', 'description' => 'Latest news and breaking stories', 'display_order' => 1],
            ['name' => 'Politics', 'slug' => 'politics', 'description' => 'Political news, analysis and reports', 'display_order' => 2],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business news, markets and economy', 'display_order' => 3],
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech news, innovation and digital trends', 'display_order' => 4],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports news, scores and updates', 'display_order' => 5],
            ['name' => 'Entertainment', 'slug' => 'entertainment', 'description' => 'Entertainment news and celebrity updates', 'display_order' => 6],
            ['name' => 'World', 'slug' => 'world', 'description' => 'International news and global affairs', 'display_order' => 7],
            ['name' => 'Africa', 'slug' => 'africa', 'description' => 'African news and developments', 'display_order' => 8],
            ['name' => 'Opinion', 'slug' => 'opinion', 'description' => 'Opinion pieces and editorials', 'display_order' => 9],
            ['name' => 'Editorial', 'slug' => 'editorial', 'description' => 'Editorial content and perspectives', 'display_order' => 10],
            ['name' => 'Health', 'slug' => 'health', 'description' => 'Health news and medical updates', 'display_order' => 11],
            ['name' => 'Education', 'slug' => 'education', 'description' => 'Education news and academic updates', 'display_order' => 12],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        $this->command->info('Created ' . count($categories) . ' categories.');
    }
}
