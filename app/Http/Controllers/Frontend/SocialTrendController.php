<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class SocialTrendController extends Controller
{
    public function show($slug)
    {
        $categoryId = Category::where('slug', 'social-trends')->value('id');

        $article = Article::where('slug', $slug)
            ->where('category_id', $categoryId)
            ->where('status', 'published')
            ->firstOrFail();

        return view('frontend.social-trends.show', compact('article'));
    }
}
