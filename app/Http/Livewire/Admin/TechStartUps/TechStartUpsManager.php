<?php

namespace App\Http\Livewire\Admin\TechStartUps;

use App\Http\Livewire\Admin\Articles\ArticleManager;

class TechStartUpsManager extends ArticleManager
{
    public function mount($article = null)
    {
        parent::mount($article);

        $categoryId = \App\Models\Category::where('slug', 'tech-start-ups')->value('id');
        if ($categoryId) {
            $this->category_id = $categoryId;
        }
    }

    public function render()
    {
        return parent::render();
    }
}
