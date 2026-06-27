<?php

namespace App\Http\Livewire\Admin\Media;

use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MediaManager extends Component
{
    use WithFileUploads;

    public $upload;
    public $alt_text;
    public $caption;

    protected function rules()
    {
        return [
            'upload' => 'required|file|max:102400',
            'alt_text' => 'nullable|max:500',
            'caption' => 'nullable|max:1000',
        ];
    }

    public function save()
    {
        $this->validate();

        $path = $this->upload->store('media', 'public');

        Media::create([
            'user_id' => Auth::id(),
            'name' => pathinfo($this->upload->getClientOriginalName(), PATHINFO_FILENAME),
            'file_name' => $this->upload->hashName(),
            'mime_type' => $this->upload->getMimeType(),
            'path' => $path,
            'disk' => 'public',
            'size' => $this->upload->getSize(),
            'alt_text' => $this->alt_text,
            'caption' => $this->caption,
        ]);

        $this->reset();
        session()->flash('message', 'Media uploaded successfully.');

        return redirect()->route('admin.media.index');
    }

    public function render()
    {
        return view('admin.media.form')->layout('layouts.app');
    }
}
