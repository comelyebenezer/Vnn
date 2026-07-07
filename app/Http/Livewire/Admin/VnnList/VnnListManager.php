<?php

namespace App\Http\Livewire\Admin\VnnList;

use App\Http\Livewire\Admin\Articles\ArticleManager;

class VnnListManager extends ArticleManager
{
    public function mount($article = null)
    {
        parent::mount($article);

        $categoryId = \App\Models\Category::where('slug', 'vnn-list')->value('id');
        if ($categoryId) {
            $this->category_id = $categoryId;
        }
    }

    public function render()
    {
        return parent::render();
    }
}
