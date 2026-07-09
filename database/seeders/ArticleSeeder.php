<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\BreakingNews;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::where('email', 'comely@vnn.ng')->first()
            ?? \App\Models\User::where('email', 'admin@vnn.ng')->first()
            ?? \App\Models\User::first();
        if (!$user) return;

        $now = now();
        $day = 0;

        $articles = [
            // News (1)
            ['category_id' => 1, 'title' => 'President Signs New Electricity Act to Boost Power Sector Reforms', 'featured' => true, 'breaking' => true, 'trending' => true, 'type' => null],
            ['category_id' => 1, 'title' => 'NAFDAC Issues Fresh Warning on Counterfeit Drugs in Open Markets', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],
            ['category_id' => 1, 'title' => 'Flood Alert: NIMET Predicts Heavy Rainfall Across 12 States', 'featured' => false, 'breaking' => true, 'trending' => true, 'type' => null],

            // Politics (2)
            ['category_id' => 2, 'title' => 'Senate Passes Electoral Reform Bill After Heated Debate', 'featured' => false, 'breaking' => true, 'trending' => true, 'type' => null],
            ['category_id' => 2, 'title' => 'Supreme Court Delivers Landmark Judgment on Local Government Autonomy', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],
            ['category_id' => 2, 'title' => 'INEC Announces Timetable for Upcoming Governorship Elections', 'featured' => false, 'breaking' => true, 'trending' => false, 'type' => null],

            // Business (3)
            ['category_id' => 3, 'title' => 'Dangote Refinery Begins Full Production, Targets European Market', 'featured' => true, 'breaking' => false, 'trending' => true, 'type' => null],
            ['category_id' => 3, 'title' => 'Naira Strengthens Against Dollar as CBN Introduces New Forex Measures', 'featured' => false, 'breaking' => true, 'trending' => true, 'type' => null],
            ['category_id' => 3, 'title' => 'MTN Nigeria Reports 12% Revenue Growth in Q2 2026', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Technology (4)
            ['category_id' => 4, 'title' => 'Flutterwave Secures $150 Million to Expand Across African Markets', 'featured' => true, 'breaking' => false, 'trending' => true, 'type' => 'video'],
            ['category_id' => 4, 'title' => 'Nigeria\'s Tech Ecosystem Attracts $1.2 Billion in H1 2026', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Sports (5)
            ['category_id' => 5, 'title' => 'Super Eagles Qualify for 2026 World Cup After Dramatic Victory', 'featured' => true, 'breaking' => true, 'trending' => true, 'type' => 'video'],
            ['category_id' => 5, 'title' => 'Anthony Joshua Announces Return Fight Scheduled for December', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Entertainment (6)
            ['category_id' => 6, 'title' => 'Burna Boy Wins Fourth Grammy Award for Best Global Album', 'featured' => true, 'breaking' => true, 'trending' => true, 'type' => null],
            ['category_id' => 6, 'title' => 'Nollywood Film "Lagos Calling" Breaks Box Office Records', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // World (7)
            ['category_id' => 7, 'title' => 'UN Security Council Adopts New Resolution on Climate Security', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],
            ['category_id' => 7, 'title' => 'G7 Leaders Pledge $50 Billion for African Infrastructure Development', 'featured' => false, 'breaking' => true, 'trending' => false, 'type' => null],

            // Africa (8)
            ['category_id' => 8, 'title' => 'African Continental Free Trade Area Records $20 Billion in First Year', 'featured' => false, 'breaking' => false, 'trending' => true, 'type' => 'podcast'],
            ['category_id' => 8, 'title' => 'Kenya Hosts Pan-African Tech Summit with 40 Nations in Attendance', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Opinion (9)
            ['category_id' => 9, 'title' => 'Rethinking Nigeria\'s Economic Diversification Strategy', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],
            ['category_id' => 9, 'title' => 'Why Youth Participation in Politics Matters More Than Ever', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Editorial (10)
            ['category_id' => 10, 'title' => 'The Path to Sustainable Healthcare Financing in Nigeria', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],
            ['category_id' => 10, 'title' => 'A Call for Electoral Integrity and Institutional Reform', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Health (11)
            ['category_id' => 11, 'title' => 'Lassa Fever Outbreak: Health Ministry Deploys Rapid Response Teams', 'featured' => false, 'breaking' => true, 'trending' => false, 'type' => null],
            ['category_id' => 11, 'title' => 'Nigeria Achieves 80% Polio Vaccination Coverage in High-Risk Zones', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Education (12)
            ['category_id' => 12, 'title' => 'Federal Government Announces Free Secondary Education Policy', 'featured' => false, 'breaking' => true, 'trending' => false, 'type' => null],
            ['category_id' => 12, 'title' => 'UNICEF Reports 2 Million More Nigerian Children Enrolled in Schools', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => null],

            // Podcast (type='podcast' - across different categories)
            ['category_id' => 3, 'title' => 'VNN Business Weekly: Market Analysis and Economic Outlook for Q3 2026', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => 'podcast'],
            ['category_id' => 5, 'title' => 'VNN Sports Desk: World Cup Qualifiers Special Edition', 'featured' => false, 'breaking' => false, 'trending' => false, 'type' => 'podcast'],
        ];

        $featuredImage = null;

        foreach ($articles as $i => $item) {
            $catId = $item['category_id'];
            $cat = \App\Models\Category::find($catId);
            $catName = $cat ? $cat->name : 'News';

            $body = '<p>' . $item['title'] . '. This comprehensive report by Verve News Network brings you detailed analysis, expert opinions, and on-the-ground perspectives on this developing story.</p>';
            $body .= '<p>Our journalists have gathered exclusive insights from key stakeholders, government officials, and industry experts to provide a complete picture of the situation and its implications for Nigerians.</p>';
            $body .= '<p>Stay with Verve News Network for continuous updates, in-depth analysis, and breaking developments on this and other important stories shaping Nigeria and the world.</p>';

            $article = Article::create([
                'user_id' => $user->id,
                'category_id' => $catId,
                'title' => $item['title'],
                'slug' => Str::slug($item['title']) . '-' . Str::random(4),
                'excerpt' => $item['title'] . ' — Verve News Network brings you comprehensive coverage and expert analysis on this important development.',
                'body' => $body,
                'status' => 'published',
                'publication_date' => $now->subHours($day * 4 + $i * 2),
                'is_featured' => $item['featured'],
                'is_breaking' => $item['breaking'],
                'is_trending' => $item['trending'],
                'is_editor_pick' => $i < 3,
                'allow_comments' => true,
                'view_count' => rand(200, 15000),
                'reading_time' => rand(3, 12),
                'type' => $item['type'] ?? 'article',
                'editor_id' => $user->id,
                'publisher_id' => $user->id,
            ]);

            $day += 0.5;
        }

        // Create Breaking News entries
        $breakingTitles = [
            'Supreme Court to Deliver Verdict on Local Government Autonomy Case Tomorrow',
            'Oil Prices Surge as OPEC Announces Production Cuts',
            'NLC Announces Nationwide Strike Over Fuel Price Hike',
            'Central Bank Unveils New Naira Redesign Policy Effective Next Month',
            'Major Flooding Displaces Thousands in Northern States',
        ];
        foreach ($breakingTitles as $i => $title) {
            BreakingNews::create([
                'title' => $title,
                'content' => $title . ' — Stay tuned to Verve News Network for continuous updates on this developing story.',
                'status' => 'active',
                'priority' => 5 - $i,
                'expires_at' => $now->addDays(2),
            ]);
        }

        // Sync pivot table so Category->articles() relationship works
        $published = Article::where('status', 'published')->get();
        foreach ($published as $a) {
            if ($a->category_id) {
                \Illuminate\Support\Facades\DB::table('article_category')->insertOrIgnore([
                    'article_id' => $a->id,
                    'category_id' => $a->category_id,
                ]);
            }
        }

        $this->command->info('Seeded ' . count($articles) . ' articles and 5 breaking news entries.');
    }
}
