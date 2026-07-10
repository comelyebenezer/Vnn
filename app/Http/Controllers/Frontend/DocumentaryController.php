<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

class DocumentaryController extends Controller
{
    public function __invoke()
    {
        $category = Category::where('slug', 'documentary')->where('status', 'active')->first();

        $documentaries = $category
            ? Article::where('category_id', $category->id)
                ->where('status', 'published')
                ->orderBy('publication_date', 'desc')
                ->paginate(12)
            : collect([]);

        $featured = $category
            ? Article::where('category_id', $category->id)
                ->where('status', 'published')
                ->where('is_featured', true)
                ->latest('publication_date')
                ->first()
            : null;

        $tags = Tag::whereHas('articles', function ($q) use ($category) {
            $q->where('category_id', $category?->id)->where('status', 'published');
        })->orderBy('name')->get();

        $count = $category
            ? Article::where('category_id', $category->id)->where('status', 'published')->count()
            : 0;

        return view('frontend.documentary.index', compact('documentaries', 'featured', 'tags', 'count'));
    }
}
