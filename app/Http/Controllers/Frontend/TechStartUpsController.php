<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class TechStartUpsController extends Controller
{
    public function __invoke()
    {
        $category = Category::where('slug', 'tech-start-ups')->where('status', 'active')->first();

        $articles = $category
            ? Article::where('category_id', $category->id)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->orderBy('publication_date', 'desc')
                ->paginate(12)
            : collect([]);

        $featured = $category
            ? Article::where('category_id', $category->id)
                ->where('status', 'published')
                ->where('is_featured', true)
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->first()
            : null;

        $tags = $category
            ? Tag::whereHas('articles', function ($q) use ($category) {
                $q->where('category_id', $category->id)->where('status', 'published');
            })->orderBy('name')->get()
            : collect([]);

        $count = $category
            ? Article::where('category_id', $category->id)->where('status', 'published')->count()
            : 0;

        return view('frontend.tech-start-ups.index', compact('articles', 'featured', 'tags', 'count'));
    }
}
