<?php

namespace App\Http\Livewire\Admin\Gallery;

use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class GalleryManager extends Component
{
    use WithFileUploads;

    public $galleryId;
    public $title;
    public $image;
    public $caption;
    public $status = 'published';
    public $sort_order = 0;

    public $editMode = false;
    public $existingImage;

    protected function rules()
    {
        $rules = [
            'title' => 'required|min:2|max:255',
            'caption' => 'nullable|max:500',
            'status' => 'required|in:published,draft',
            'sort_order' => 'nullable|integer|min:0',
        ];

        if (!$this->existingImage || $this->image) {
            $rules['image'] = 'required|image|max:2048';
        }

        return $rules;
    }

    public function mount($gallery = null)
    {
        if ($gallery) {
            if (is_string($gallery) || is_int($gallery)) {
                $gallery = Gallery::findOrFail($gallery);
            }

            $this->editMode = true;
            $this->galleryId = $gallery->id;
            $this->title = $gallery->title;
            $this->caption = $gallery->caption;
            $this->status = $gallery->status;
            $this->sort_order = $gallery->sort_order;
            $this->existingImage = $gallery->image;
        }
    }

    public function save()
    {
        $this->validate();

        $imagePath = $this->existingImage;

        if ($this->image) {
            $imagePath = $this->image->store('gallery', 'public');
        }

        $data = [
            'title' => $this->title,
            'image' => $imagePath,
            'caption' => $this->caption,
            'status' => $this->status,
            'sort_order' => $this->sort_order,
        ];

        if ($this->editMode) {
            Gallery::findOrFail($this->galleryId)->update($data);
            session()->flash('message', 'Gallery image updated successfully.');
        } else {
            $data['user_id'] = Auth::id();
            Gallery::create($data);
            $this->reset();
            session()->flash('message', 'Gallery image created successfully.');
        }

        return redirect()->route('admin.gallery.index');
    }

    public function render()
    {
        return view('admin.gallery.form')->layout('layouts.app');
    }
}
