<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Verve News Network', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Nigeria\'s Most Trusted News Source', 'group' => 'general'],
            ['key' => 'site_email', 'value' => 'info@vnn.ng', 'group' => 'general'],
            ['key' => 'site_phone', 'value' => '+234 800 VNN NEWS', 'group' => 'general'],
            ['key' => 'site_address', 'value' => 'Abuja, Nigeria', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Verve News Network - Nigeria\'s premier source for breaking news, politics, business, sports, entertainment, and in-depth analysis.', 'group' => 'seo'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/vervenews', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/vervenews', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/vervenews', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => 'https://youtube.com/@vervenews', 'group' => 'social'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Seeded ' . count($settings) . ' settings.');
    }
}
