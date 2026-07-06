<?php

namespace App\Http\Livewire\Admin\Videos;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class VideoManager extends Component
{
    use WithFileUploads;

    public $videoId;
    public $title;
    public $slug;
    public $description;
    public $url;
    public $video_file_upload;
    public $video_source = 'url';
    public $embed_code;
    public $thumbnail;
    public $thumbnail_upload;
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
            'video_file_upload' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv,mkv,webm|max:512000',
            'embed_code' => 'nullable|max:2000',
            'thumbnail' => 'nullable|max:500',
            'thumbnail_upload' => 'nullable|image|max:5120',
            'duration' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'is_top' => 'boolean',
        ];
    }

    public function mount($video = null)
    {
        if ($video) {
            if (is_string($video) || is_int($video)) {
                $video = \App\Models\Video::findOrFail($video);
            }

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

            if ($video->video_file) {
                $this->video_source = 'upload';
            }
        }
    }

    public function updatedVideoSource($value)
    {
        if ($value === 'url') {
            $this->video_file_upload = null;
        } else {
            $this->url = null;
            $this->embed_code = null;
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

        $videoFilePath = null;
        if ($this->video_source === 'upload' && $this->video_file_upload) {
            $videoFilePath = $this->video_file_upload->store('videos', 'public');
        }

        $thumbnailPath = $this->thumbnail;
        if ($this->thumbnail_upload) {
            $thumbnailPath = $this->thumbnail_upload->store('thumbnails', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'url' => $this->video_source === 'url' ? $this->url : null,
            'video_file' => $videoFilePath,
            'embed_code' => $this->video_source === 'url' ? $this->embed_code : null,
            'thumbnail' => $thumbnailPath,
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
