<?php

namespace App\Http\Livewire\Admin\Subcategories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Livewire\Component;

class SubcategoryManager extends Component
{
    public $subcategoryId;
    public $category_id;
    public $name;
    public $slug;
    public $description;
    public $status = 'active';

    public $editMode = false;

    protected function rules()
    {
        return [
            'category_id' => 'required|exists:categories,id',
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
                $subcategory = Subcategory::findOrFail($subcategory);
            }

            $this->editMode = true;
            $this->subcategoryId = $subcategory->id;
            $this->category_id = $subcategory->category_id;
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

        $data = [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if ($this->editMode) {
            Subcategory::findOrFail($this->subcategoryId)->update($data);
            session()->flash('message', 'Subcategory updated successfully.');
        } else {
            Subcategory::create($data);
            $this->reset();
            session()->flash('message', 'Subcategory created successfully.');
        }

        return redirect()->route('admin.subcategories.index');
    }

    public function render()
    {
        return view('admin.subcategories.form', [
            'categories' => Category::where('status', 'active')->orderBy('name')->get(),
        ])->layout('layouts.app');
    }
}
