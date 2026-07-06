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
    public $video_url;
    public $video_type = 'youtube';
    public $video_file_upload;
    public $video_source = 'url';
    public $is_live = false;
    public $status = 'active';

    public $editMode = false;

    protected function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'description' => 'nullable|max:2000',
            'video_url' => 'nullable|url|max:500',
            'video_type' => 'required|in:youtube,facebook,vimeo,other',
            'video_file_upload' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv,mkv,webm|max:512000',
            'is_live' => 'boolean',
            'status' => 'required|in:active,inactive',
        ];
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
            $this->video_url = $live->video_url;
            $this->video_type = $live->video_type;
            $this->is_live = $live->is_live;
            $this->status = $live->status;

            if ($live->video_file) {
                $this->video_source = 'upload';
            }
        }
    }

    public function updatedVideoSource($value)
    {
        if ($value === 'url') {
            $this->video_file_upload = null;
        } else {
            $this->video_url = null;
        }
    }

    public function save()
    {
        $this->validate();

        $videoFilePath = null;
        if ($this->video_source === 'upload' && $this->video_file_upload) {
            $videoFilePath = $this->video_file_upload->store('live-videos', 'public');
        }

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'video_url' => $this->video_source === 'url' ? $this->video_url : null,
            'video_type' => $this->video_source === 'url' ? $this->video_type : 'uploaded',
            'video_file' => $videoFilePath,
            'is_live' => $this->is_live,
            'status' => $this->status,
        ];

        if ($this->editMode) {
            LiveUpdate::findOrFail($this->liveId)->update($data);
            session()->flash('message', 'Live video updated successfully.');
        } else {
            LiveUpdate::create($data);
            $this->reset();
            session()->flash('message', 'Live video created successfully.');
        }

        return redirect()->route('admin.live.index');
    }

    public function render()
    {
        return view('admin.live.form')->layout('layouts.app');
    }
}
