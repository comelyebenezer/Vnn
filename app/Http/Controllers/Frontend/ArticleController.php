<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::where('slug', $slug)
            ->where('status', 'published')
            ->with(['author', 'category', 'tags', 'editor', 'publisher', 'factChecker', 'comments.user', 'seo'])
            ->firstOrFail();

        $article->increment('view_count');

        $related = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->limit(4)
            ->get();

        $trending = Article::where('status', 'published')
            ->orderBy('view_count', 'desc')
            ->limit(5)
            ->get();

        return view('frontend.articles.show', compact('article', 'related', 'trending'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->where('status', 'active')->first();
        $articles = $category
            ? Article::where('category_id', $category->id)->where('status', 'published')->orderBy('publication_date', 'desc')->paginate(20)
            : collect([]);

        return view('frontend.categories.show', compact('category', 'articles'));
    }

    public function tag($slug)
    {
        $tag = \App\Models\Tag::where('slug', $slug)->firstOrFail();
        $articles = $tag->articles()->where('status', 'published')->orderBy('publication_date', 'desc')->paginate(20);

        return view('frontend.tags.show', compact('tag', 'articles'));
    }
}
