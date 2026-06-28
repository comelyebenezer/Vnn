<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class VnnListController extends Controller
{
    public function __invoke()
    {
        $category = Category::where('slug', 'vnn-list')->where('status', 'active')->first();

        $listings = $category
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

        $count = $category
            ? Article::where('category_id', $category->id)->where('status', 'published')->count()
            : 0;

        $industries = $category
            ? Article::where('category_id', $category->id)
                ->where('status', 'published')
                ->selectRaw('DISTINCT JSON_UNQUOTE(JSON_EXTRACT(meta, "$.industry")) as industry')
                ->pluck('industry')
                ->filter()
                ->values()
            : collect([]);

        return view('frontend.vnn-list.index', compact('listings', 'featured', 'count', 'industries'));
    }
}
