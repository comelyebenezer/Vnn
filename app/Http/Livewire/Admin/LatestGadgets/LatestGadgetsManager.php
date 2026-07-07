<?php

namespace App\Http\Livewire\Admin\LatestGadgets;

use App\Http\Livewire\Admin\Articles\ArticleManager;

class LatestGadgetsManager extends ArticleManager
{
    public function mount($article = null)
    {
        parent::mount($article);

        $categoryId = \App\Models\Category::where('slug', 'latest-gadgets')->value('id');
        if ($categoryId) {
            $this->category_id = $categoryId;
        }
    }

    public function render()
    {
        return parent::render();
    }
}
