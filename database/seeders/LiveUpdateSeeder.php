<?php

namespace Database\Seeders;

use App\Models\LiveUpdate;
use Illuminate\Database\Seeder;

class LiveUpdateSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Presidential Address on Economic Reforms',
                'description' => 'Live coverage of the President\'s nationwide address on new economic policies and reforms aimed at stabilizing the naira.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Senate Plenary Session on Electoral Bill',
                'description' => 'Live from the National Assembly as the Senate debates the proposed Electoral Reform Bill 2026.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => true,
                'status' => 'active',
            ],
            [
                'title' => 'World Cup Qualifiers: Nigeria vs Ghana',
                'description' => 'Live match coverage and post-game analysis of the Super Eagles World Cup qualifying match.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => false,
                'status' => 'active',
            ],
            [
                'title' => 'Breaking News: Supreme Court Verdict',
                'description' => 'VNN reporters provide live updates as the Supreme Court delivers its landmark judgment on local government autonomy.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => true,
                'status' => 'active',
            ],
            [
                'title' => 'Nigerian Stock Market Weekly Review',
                'description' => 'Analysis of this week\'s market performance, top gainers, and economic outlook for investors.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => false,
                'status' => 'active',
            ],
            [
                'title' => 'Technology Summit 2026: Day 2 Highlights',
                'description' => 'Coverage of the Pan-African Technology Summit featuring innovators and investors from across the continent.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => false,
                'status' => 'active',
            ],
            [
                'title' => 'Health Ministry Press Briefing on Lassa Fever',
                'description' => 'The Minister of Health provides updates on the government\'s response to the Lassa fever outbreak.',
                'video_url' => 'https://www.youtube.com/embed/dQw4w9WgXcQ',
                'video_type' => 'youtube',
                'is_live' => false,
                'status' => 'active',
            ],
        ];

        foreach ($items as $item) {
            LiveUpdate::create($item);
        }

        $this->command->info('Seeded ' . count($items) . ' live updates.');
    }
}
