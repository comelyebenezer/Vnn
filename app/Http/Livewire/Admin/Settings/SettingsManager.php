<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SettingsManager extends Component
{
    use WithFileUploads;

    public $general = [];
    public $social = [];
    public $seo = [];
    public $logo;
    public $existingLogo;

    protected function rules()
    {
        return [
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
            'logo' => 'nullable|image|max:2048|mimes:png,jpg,jpeg,svg,webp',
        ];
    }

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

        $logoSetting = Setting::where('key', 'site_logo')->first();
        $this->existingLogo = $logoSetting ? $logoSetting->value : null;
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

        if ($this->logo) {
            $path = $this->logo->store('settings', 'public');
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $path, 'group' => 'general']
            );
            $this->existingLogo = $path;
            $this->logo = null;
        }

        session()->flash('message', 'Settings saved successfully.');
    }

    public function removeLogo()
    {
        if ($this->existingLogo) {
            Storage::disk('public')->delete($this->existingLogo);
            Setting::where('key', 'site_logo')->delete();
            $this->existingLogo = null;
        }
    }

    public function render()
    {
        return view('admin.settings.index')->layout('layouts.app');
    }
}
