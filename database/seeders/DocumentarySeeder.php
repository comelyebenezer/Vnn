<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DocumentarySeeder extends Seeder
{
    public function run(): void
    {
        $user = \App\Models\User::first();
        if (!$user) return;

        $author = Author::firstOrCreate(
            ['user_id' => $user->id],
            [
                'bio' => 'Lead documentary filmmaker and investigative journalist at Verve News Network.',
                'expertise' => 'Investigative Journalism, Documentary Production',
                'is_featured' => true,
            ]
        );

        $catId = Category::where('slug', 'documentary')->value('id');
        if (!$catId) return;

        $docs = [
            [
                'title' => 'Governors of Power: Inside Nigeria\'s State Houses',
                'excerpt' => 'An exclusive behind-the-scenes look at the men who govern Nigeria\'s 36 states — their triumphs, controversies, and the machinery of state power.',
                'is_featured' => true,
                'reading_time' => 42,
            ],
            [
                'title' => 'The Billionaire\'s Blueprint: Nigeria\'s Business Magnates',
                'excerpt' => 'From Lagos to London, tracing the journeys of Nigeria\'s most influential businessmen and the empires they built.',
                'reading_time' => 38,
            ],
            [
                'title' => 'Nollywood Unscripted: The Stars Behind the Screen',
                'excerpt' => 'An intimate portrait of Nigeria\'s film industry — the actors, directors, and producers who turned Nollywood into a global phenomenon.',
                'reading_time' => 45,
            ],
            [
                'title' => 'Super Eagles: The Untold Stories of Nigeria\'s Football Legends',
                'excerpt' => 'From the黄金 era to the modern game, the personal stories of the athletes who carried a nation\'s hopes on their shoulders.',
                'reading_time' => 52,
            ],
            [
                'title' => 'The Corridors of Aso Rock: Power, Politics, and Policy',
                'excerpt' => 'An unprecedented look inside the presidential villa — the decisions, the debates, and the personalities shaping Nigeria\'s destiny.',
                'reading_time' => 48,
            ],
            [
                'title' => 'Music, Money, and Fame: The New Wave of Nigerian Entertainment',
                'excerpt' => 'How Afrobeat conquered the world and the entertainers who turned Nigerian music into a multi-billion dollar industry.',
                'reading_time' => 35,
            ],
            [
                'title' => 'Market Movers: The Tycoons of Nigerian Commerce',
                'excerpt' => 'From Balogun Market to the Stock Exchange, the entrepreneurs and traders who drive Nigeria\'s informal and formal economies.',
                'reading_time' => 40,
            ],
            [
                'title' => 'Tradition Bearers: Custodians of Nigeria\'s Cultural Heritage',
                'excerpt' => 'Preserving Nigeria\'s rich cultural legacy — the monarchs, artisans, and storytellers keeping centuries-old traditions alive.',
                'reading_time' => 44,
            ],
        ];

        $now = now();
        foreach ($docs as $i => $doc) {
            Article::create([
                'user_id' => $user->id,
                'category_id' => $catId,
                'title' => $doc['title'],
                'slug' => \Illuminate\Support\Str::slug($doc['title']),
                'excerpt' => $doc['excerpt'],
                'body' => '<p>' . $doc['excerpt'] . ' This in-depth documentary explores the subject through exclusive interviews, archival footage, and on-the-ground reporting across Nigeria.</p><p>Through unprecedented access and meticulous research, VNN Documentary presents a comprehensive portrait of the individuals and institutions that define contemporary Nigeria.</p><p>Watch the full documentary on VNN — available in 4K Ultra HD with original scoring and professional narration.</p>',
                'status' => 'published',
                'publication_date' => $now->subDays(($i + 1) * 3),
                'is_featured' => $doc['is_featured'] ?? false,
                'is_breaking' => false,
                'is_trending' => $i < 3,
                'is_editor_pick' => $i < 2,
                'allow_comments' => true,
                'view_count' => rand(500, 5000),
                'reading_time' => $doc['reading_time'],
                'type' => 'documentary',
                'editor_id' => $user->id,
                'publisher_id' => $user->id,
            ]);
        }

        $this->command->info('Seeded ' . count($docs) . ' documentary articles.');
    }
}
