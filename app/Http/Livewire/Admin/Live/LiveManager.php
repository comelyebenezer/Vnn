<?php

namespace App\Http\Livewire\Admin\Live;

use App\Models\LiveUpdate;
use Livewire\Component;

class LiveManager extends Component
{
    public $liveId;
    public $title;
    public $description;
    public $video_url;
    public $video_type = 'youtube';
    public $video_file;
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
            'video_file' => 'nullable|max:500',
            'is_live' => 'boolean',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function mount($live = null)
    {
        if ($live) {
            $this->editMode = true;
            $this->liveId = $live->id;
            $this->title = $live->title;
            $this->description = $live->description;
            $this->video_url = $live->video_url;
            $this->video_type = $live->video_type;
            $this->video_file = $live->video_file;
            $this->is_live = $live->is_live;
            $this->status = $live->status;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'video_url' => $this->video_url,
            'video_type' => $this->video_type,
            'video_file' => $this->video_file,
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
