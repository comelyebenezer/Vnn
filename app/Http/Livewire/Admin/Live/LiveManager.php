<?php

namespace App\Http\Livewire\Admin\Live;

use App\Models\LiveUpdate;
use Livewire\Component;
use Livewire\WithFileUploads;

class LiveManager extends Component
{
    use WithFileUploads;

    public $liveId;
    public $title;
    public $description;
    public $media_type = 'video';
    public $video_url;
    public $video_type = 'youtube';
    public $video_file_upload;
    public $image_file_upload;
    public $video_source = 'url';
    public $is_live = false;
    public $status = 'active';

    public $editMode = false;

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:2|max:255',
            'description' => 'nullable|max:2000',
            'media_type' => 'required|in:video,image',
            'is_live' => 'boolean',
            'status' => 'required|in:active,inactive',
        ];

        if ($this->media_type === 'video') {
            if ($this->video_source === 'url') {
                $rules['video_url'] = 'required|url|max:500';
                $rules['video_type'] = 'required|in:youtube,facebook,vimeo,other';
            } else {
                $rules['video_file_upload'] = $this->editMode ? 'nullable|file|mimes:mp4,avi,mov,wmv,flv,mkv,webm|max:512000' : 'required|file|mimes:mp4,avi,mov,wmv,flv,mkv,webm|max:512000';
            }
        } else {
            $rules['image_file_upload'] = $this->editMode ? 'nullable|image|max:10240' : 'required|image|max:10240';
        }

        return $rules;
    }

    public function mount($live = null)
    {
        if ($live) {
            if (is_string($live) || is_int($live)) {
                $live = \App\Models\LiveUpdate::findOrFail($live);
            }

            $this->editMode = true;
            $this->liveId = $live->id;
            $this->title = $live->title;
            $this->description = $live->description;
            $this->media_type = $live->media_type ?? 'video';
            $this->is_live = $live->is_live;
            $this->status = $live->status;

            if ($this->media_type === 'video') {
                $this->video_url = $live->video_url;
                $this->video_type = $live->video_type ?: 'other';
                if ($live->video_file) {
                    $this->video_source = 'upload';
                }
            }
        }
    }

    public function updatedMediaType($value)
    {
        $this->video_url = null;
        $this->video_file_upload = null;
        $this->image_file_upload = null;
        $this->video_source = 'url';
        $this->video_type = 'youtube';
    }

    public function updatedVideoSource($value)
    {
        if ($value === 'url') {
            $this->video_file_upload = null;
        } else {
            $this->video_url = null;
            $this->video_type = 'other';
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'media_type' => $this->media_type,
            'is_live' => $this->is_live,
            'status' => $this->status,
        ];

        if ($this->editMode) {
            $live = LiveUpdate::findOrFail($this->liveId);

            if ($this->media_type === 'video') {
                $videoFilePath = $live->video_file;
                if ($this->video_source === 'upload' && $this->video_file_upload) {
                    $videoFilePath = $this->video_file_upload->store('live-videos', 'public');
                } elseif ($this->video_source === 'url') {
                    $videoFilePath = null;
                }
                $data['video_url'] = $this->video_source === 'url' ? $this->video_url : null;
                $data['video_type'] = $this->video_source === 'url' ? $this->video_type : 'uploaded';
                $data['video_file'] = $videoFilePath;
                $data['image_file'] = null;
            } else {
                $imageFilePath = $live->image_file;
                if ($this->image_file_upload) {
                    $imageFilePath = $this->image_file_upload->store('live-images', 'public');
                }
                $data['image_file'] = $imageFilePath;
                $data['video_url'] = null;
                $data['video_type'] = null;
                $data['video_file'] = null;
            }

            $live->update($data);
            session()->flash('message', 'Live update updated successfully.');
        } else {
            if ($this->media_type === 'video') {
                $videoFilePath = null;
                if ($this->video_source === 'upload' && $this->video_file_upload) {
                    $videoFilePath = $this->video_file_upload->store('live-videos', 'public');
                }
                $data['video_url'] = $this->video_source === 'url' ? $this->video_url : null;
                $data['video_type'] = $this->video_source === 'url' ? $this->video_type : 'uploaded';
                $data['video_file'] = $videoFilePath;
                $data['image_file'] = null;
            } else {
                $imageFilePath = null;
                if ($this->image_file_upload) {
                    $imageFilePath = $this->image_file_upload->store('live-images', 'public');
                }
                $data['image_file'] = $imageFilePath;
                $data['video_url'] = null;
                $data['video_type'] = null;
                $data['video_file'] = null;
            }

            LiveUpdate::create($data);
            $this->reset();
            session()->flash('message', 'Live update created successfully.');
        }

        return redirect()->route('admin.live.index');
    }

    public function render()
    {
        return view('admin.live.form')->layout('layouts.app');
    }
}
