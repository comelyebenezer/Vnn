<?php

namespace App\Http\Livewire\Admin\Tags;

use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Component;

class TagManager extends Component
{
    public $tagId;
    public $name;
    public $slug;

    public $editMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'slug' => 'required|unique:tags,slug,' . $this->tagId,
        ];
    }

    public function mount($tag = null)
    {
        if ($tag) {
            $this->editMode = true;
            $this->tagId = $tag->id;
            $this->name = $tag->name;
            $this->slug = $tag->slug;
        }
    }

    public function updatedName($value)
    {
        if (!$this->editMode) {
            $this->slug = Str::slug($value);
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
        ];

        if ($this->editMode) {
            Tag::findOrFail($this->tagId)->update($data);
            session()->flash('message', 'Tag updated successfully.');
        } else {
            Tag::create($data);
            $this->reset();
            session()->flash('message', 'Tag created successfully.');
        }

        return redirect()->route('admin.tags.index');
    }

    public function render()
    {
        return view('admin.tags.form')->layout('layouts.app');
    }
}
