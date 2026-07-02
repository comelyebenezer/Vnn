<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class VideoManager extends Component
{
    public $videoId;
    public $title;
    public $slug;
    public $description;
    public $url;
    public $embed_code;
    public $thumbnail;
    public $duration;
    public $category_id;
    public $status = 'draft';
    public $is_top = false;

    public $editMode = false;

    protected function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'slug' => 'required|unique:videos,slug,' . $this->videoId,
            'description' => 'nullable|max:2000',
            'url' => 'nullable|url|max:500',
            'embed_code' => 'nullable|max:2000',
            'thumbnail' => 'nullable|max:500',
            'duration' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_top' => 'boolean',
        ];
    }

    public function mount($video = null)
    {
        if ($video) {
            $this->editMode = true;
            $this->videoId = $video->id;
            $this->title = $video->title;
            $this->slug = $video->slug;
            $this->description = $video->description;
            $this->url = $video->url;
            $this->embed_code = $video->embed_code;
            $this->thumbnail = $video->thumbnail;
            $this->duration = $video->duration;
            $this->category_id = $video->category_id;
            $this->status = $video->status;
            $this->is_top = $video->is_top;
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
            'url' => $this->url,
            'embed_code' => $this->embed_code,
            'thumbnail' => $this->thumbnail,
            'duration' => $this->duration,
            'category_id' => $this->category_id ?: null,
            'status' => $this->status,
            'is_top' => $this->is_top,
        ];

        if ($this->editMode) {
            Video::findOrFail($this->videoId)->update($data);
            session()->flash('message', 'Video updated successfully.');
        } else {
            $data['user_id'] = Auth::id();
            Video::create($data);
            $this->reset();
            session()->flash('message', 'Video created successfully.');
        }

        return redirect()->route('admin.videos.index');
    }

    public function render()
    {
        return view('admin.videos.form', [
            'categories' => Category::where('status', 'active')->orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
