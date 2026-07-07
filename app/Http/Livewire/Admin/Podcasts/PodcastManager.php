<?php

namespace App\Http\Livewire\Admin\Podcasts;

use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PodcastManager extends Component
{
    use WithFileUploads;

    public $podcastId;
    public $title;
    public $slug;
    public $description;
    public $audio_url;
    public $audio_file;
    public $audio_type;
    public $cover_image;
    public $duration;
    public $episode_number;
    public $season_number;
    public $category_id;
    public $status = 'draft';

    public $editMode = false;
    public $existingAudioFile;
    public $removeAudioFile = false;

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:2|max:255',
            'slug' => 'required|unique:podcasts,slug,' . $this->podcastId,
            'description' => 'nullable|max:2000',
            'audio_url' => 'nullable|string|max:500',
            'audio_type' => 'nullable|string|in:upload,url',
            'cover_image' => 'nullable|max:500',
            'duration' => 'nullable|integer|min:0',
            'episode_number' => 'nullable|integer|min:1',
            'season_number' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
        ];

        if (!$this->removeAudioFile && $this->audio_file && !$this->existingAudioFile) {
            $rules['audio_file'] = 'required|file|mimes:mp3,mpeg,ogg,wav,webm,aac|max:102400';
        }

        return $rules;
    }

    public function mount($podcast = null)
    {
        if ($podcast) {
            if (is_string($podcast) || is_int($podcast)) {
                $podcast = \App\Models\Podcast::findOrFail($podcast);
            }

            $this->editMode = true;
            $this->podcastId = $podcast->id;
            $this->title = $podcast->title;
            $this->slug = $podcast->slug;
            $this->description = $podcast->description;
            $this->audio_url = $podcast->audio_url;
            $this->audio_type = $podcast->audio_type;
            $this->cover_image = $podcast->cover_image;
            $this->duration = $podcast->duration;
            $this->episode_number = $podcast->episode_number;
            $this->season_number = $podcast->season_number;
            $this->category_id = $podcast->category_id;
            $this->status = $podcast->status;
            $this->existingAudioFile = $podcast->audio_file;
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->editMode) {
            $this->slug = Str::slug($value);
        }
    }

    public function removeExistingAudio()
    {
        $this->removeAudioFile = true;
        $this->existingAudioFile = null;
        $this->audio_url = null;
        $this->audio_type = null;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'audio_url' => $this->audio_url,
            'cover_image' => $this->cover_image,
            'duration' => $this->duration,
            'episode_number' => $this->episode_number,
            'season_number' => $this->season_number,
            'category_id' => $this->category_id ?: null,
            'status' => $this->status,
        ];

        if ($this->removeAudioFile && $this->existingAudioFile) {
            Storage::disk('public')->delete($this->existingAudioFile);
            $data['audio_file'] = null;
            $data['audio_type'] = null;
        } elseif ($this->audio_file && !$this->removeAudioFile) {
            $path = $this->audio_file->store('podcasts/audio', 'public');
            $data['audio_file'] = $path;
            $data['audio_type'] = 'upload';
            $data['audio_url'] = null;
        }

        if ($this->editMode) {
            Podcast::findOrFail($this->podcastId)->update($data);
            session()->flash('message', 'Podcast updated successfully.');
        } else {
            $data['user_id'] = Auth::id();
            Podcast::create($data);
            $this->reset();
            session()->flash('message', 'Podcast created successfully.');
        }

        return redirect()->route('admin.podcasts.index');
    }

    public function render()
    {
        return view('admin.podcasts.form', [
            'categories' => Category::where('status', 'active')->orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
