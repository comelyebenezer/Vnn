<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;

class SettingsManager extends Component
{
    public $general = [];
    public $social = [];
    public $seo = [];

    protected $rules = [
        'general.site_name' => 'required|max:255',
        'general.site_tagline' => 'nullable|max:500',
        'general.site_email' => 'nullable|email|max:255',
        'general.site_phone' => 'nullable|max:50',
        'general.site_address' => 'nullable|max:500',
        'social.facebook_url' => 'nullable|url|max:500',
        'social.twitter_url' => 'nullable|url|max:500',
        'social.instagram_url' => 'nullable|url|max:500',
        'social.linkedin_url' => 'nullable|url|max:500',
        'social.youtube_url' => 'nullable|url|max:500',
        'seo.google_analytics_id' => 'nullable|max:100',
        'seo.meta_keywords' => 'nullable|max:500',
    ];

    public function mount()
    {
        $keys = [
            'general' => ['site_name', 'site_tagline', 'site_email', 'site_phone', 'site_address'],
            'social' => ['facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url'],
            'seo' => ['google_analytics_id', 'meta_keywords'],
        ];

        foreach ($keys as $group => $fields) {
            foreach ($fields as $field) {
                $setting = Setting::where('key', $field)->first();
                $this->{$group}[$field] = $setting ? $setting->value : '';
            }
        }
    }

    public function save()
    {
        $this->validate();

        $keys = [
            'general' => ['site_name', 'site_tagline', 'site_email', 'site_phone', 'site_address'],
            'social' => ['facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url'],
            'seo' => ['google_analytics_id', 'meta_keywords'],
        ];

        foreach ($keys as $group => $fields) {
            foreach ($fields as $field) {
                Setting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $this->{$group}[$field], 'group' => $group]
                );
            }
        }

        session()->flash('message', 'Settings saved successfully.');
    }

    public function render()
    {
        return view('admin.settings.index')->layout('layouts.app');
    }
}
