<?php

namespace App\Http\Livewire\Admin\VnnList;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\Component;

class VnnListSubcategoryManager extends Component
{
    public $subcategoryId;
    public $name;
    public $slug;
    public $description;
    public $status = 'active';

    public $editMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'slug' => 'required|unique:subcategories,slug,' . $this->subcategoryId,
            'description' => 'nullable|max:500',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function mount($subcategory = null)
    {
        if ($subcategory) {
            if (is_string($subcategory) || is_int($subcategory)) {
                $subcategory = Subcategory::with('categories')->findOrFail($subcategory);
            }

            $this->editMode = true;
            $this->subcategoryId = $subcategory->id;
            $this->name = $subcategory->name;
            $this->slug = $subcategory->slug;
            $this->description = $subcategory->description;
            $this->status = $subcategory->status;
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

        $vnnListId = Category::where('slug', 'vnn-list')->value('id');

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if ($this->editMode) {
            $subcategory = Subcategory::findOrFail($this->subcategoryId);
            $subcategory->update($data);
            if (!$subcategory->categories->contains($vnnListId)) {
                $subcategory->categories()->attach($vnnListId);
            }
            session()->flash('message', 'Subcategory updated successfully.');
        } else {
            $existing = Subcategory::where('slug', $this->slug)->first();
            if ($existing) {
                if (!$existing->categories->contains($vnnListId)) {
                    $existing->categories()->attach($vnnListId);
                }
                session()->flash('message', 'Existing subcategory linked to VNN List.');
            } else {
                $subcategory = Subcategory::create($data);
                $subcategory->categories()->attach($vnnListId);
                session()->flash('message', 'Subcategory created successfully.');
            }
        }

        return redirect()->route('admin.vnn-list.subcategories.index');
    }

    public function render()
    {
        return view('admin.vnn-list.subcategory-form')->layout('layouts.app');
    }
}
