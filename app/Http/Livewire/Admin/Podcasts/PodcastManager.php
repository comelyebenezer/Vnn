<?php

namespace App\Http\Livewire\Admin\Podcasts;

use App\Models\Category;
use App\Models\Podcast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class PodcastManager extends Component
{
    public $podcastId;
    public $title;
    public $slug;
    public $description;
    public $audio_url;
    public $cover_image;
    public $duration;
    public $episode_number;
    public $season_number;
    public $category_id;
    public $status = 'draft';

    public $editMode = false;

    protected function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'slug' => 'required|unique:podcasts,slug,' . $this->podcastId,
            'description' => 'nullable|max:2000',
            'audio_url' => 'nullable|url|max:500',
            'cover_image' => 'nullable|max:500',
            'duration' => 'nullable|integer|min:0',
            'episode_number' => 'nullable|integer|min:1',
            'season_number' => 'nullable|integer|min:1',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
        ];
    }

    public function mount($podcast = null)
    {
        if ($podcast) {
            $this->editMode = true;
            $this->podcastId = $podcast->id;
            $this->title = $podcast->title;
            $this->slug = $podcast->slug;
            $this->description = $podcast->description;
            $this->audio_url = $podcast->audio_url;
            $this->cover_image = $podcast->cover_image;
            $this->duration = $podcast->duration;
            $this->episode_number = $podcast->episode_number;
            $this->season_number = $podcast->season_number;
            $this->category_id = $podcast->category_id;
            $this->status = $podcast->status;
        }
    }

    public function updatedTitle($value)
    {
        if (!$this->editMode) {
            $this->slug = Str::slug($value);
        }
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
