<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class CategoryManager extends Component
{
    public $categoryId;
    public $name;
    public $slug;
    public $description;
    public $icon;
    public $image;
    public $parent_id;
    public $status = 'active';
    public $display_order = 0;

    public $editMode = false;

    protected function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'slug' => 'required|unique:categories,slug,' . $this->categoryId,
            'description' => 'nullable|max:500',
            'icon' => 'nullable|max:100',
            'image' => 'nullable|max:500',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'display_order' => 'integer|min:0',
        ];
    }

    public function mount($category = null)
    {
        if ($category) {
            $this->editMode = true;
            $this->categoryId = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description;
            $this->icon = $category->icon;
            $this->image = $category->image;
            $this->parent_id = $category->parent_id;
            $this->status = $category->status;
            $this->display_order = $category->display_order;
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
            'description' => $this->description,
            'icon' => $this->icon,
            'image' => $this->image,
            'parent_id' => $this->parent_id ?: null,
            'status' => $this->status,
            'display_order' => $this->display_order,
        ];

        if ($this->editMode) {
            Category::findOrFail($this->categoryId)->update($data);
            session()->flash('message', 'Category updated successfully.');
        } else {
            Category::create($data);
            $this->reset();
            session()->flash('message', 'Category created successfully.');
        }

        return redirect()->route('admin.categories.index');
    }

    public function render()
    {
        return view('admin.categories.form', [
            'categories' => Category::where('status', 'active')
                ->when($this->categoryId, fn($q) => $q->where('id', '!=', $this->categoryId))
                ->orderBy('name')
                ->get(),
        ])->layout('layouts.app');
    }
}
