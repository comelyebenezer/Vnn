<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\BreakingNews;
use App\Models\LiveUpdate;
use App\Models\Video;
use App\Models\Advertisement;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Article::where('status', 'published')
            ->where('is_featured', true)
            ->with(['category', 'author'])
            ->latest('publication_date')
            ->first();

        $topNews = Article::where('status', 'published')
            ->where('is_featured', false)
            ->with(['category'])
            ->latest('publication_date')
            ->take(5)
            ->get();

        $breakingArticles = Article::where('status', 'published')
            ->where('is_breaking', true)
            ->with(['category', 'author'])
            ->latest('publication_date')
            ->take(5)
            ->get();

        $trendingArticles = Article::where('status', 'published')
            ->where('is_trending', true)
            ->with(['category', 'author'])
            ->latest('publication_date')
            ->take(5)
            ->get();

        $editorPicks = Article::where('status', 'published')
            ->where('is_editor_pick', true)
            ->with(['category', 'author'])
            ->latest('publication_date')
            ->take(3)
            ->get();

        $sections = ['news', 'politics', 'business', 'technology', 'sports', 'entertainment', 'world'];
        $categoryArticles = [];
        foreach ($sections as $slug) {
            $category = Category::where('slug', $slug)->where('status', 'active')->first();
            if ($category) {
                $categoryArticles[$slug] = [
                    'category' => $category,
                    'main' => Article::where('category_id', $category->id)
                        ->where('status', 'published')->with(['category', 'author'])
                        ->latest('publication_date')->first(),
                    'subs' => Article::where('category_id', $category->id)
                        ->where('status', 'published')
                        ->latest('publication_date')->skip(1)->take(4)->get(),
                ];
            }
        }

        $opinions = Article::whereHas('category', fn($q) => $q->where('slug', 'opinion'))
            ->where('status', 'published')->with(['author'])
            ->latest('publication_date')->take(3)->get();

        $editorials = Article::whereHas('category', fn($q) => $q->where('slug', 'editorial'))
            ->where('status', 'published')
            ->latest('publication_date')->take(3)->get();

        $videos = Article::where('status', 'published')->where('type', 'video')
            ->latest('publication_date')->take(3)->get();

        $podcasts = Article::where('status', 'published')->where('type', 'podcast')
            ->latest('publication_date')->take(3)->get();

        $latest = Article::where('status', 'published')
            ->with(['category'])
            ->latest('publication_date')->take(6)->get();

        $mostRead = Article::where('status', 'published')
            ->orderBy('view_count', 'desc')->take(5)->get();

        $breakingNews = BreakingNews::where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->latest()->take(5)->get();

        $liveUpdates = LiveUpdate::live()->latest()->take(2)->get();

        $trendingVideos = Video::where('is_top', true)->where('status', 'published')->latest()->take(2)->get();

        $navCategories = Category::where('status', 'active')->orderBy('display_order')->get();

        $advertisements = Advertisement::where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->get()
            ->groupBy('type');

        return view('frontend.home.index', compact(
            'featured', 'topNews', 'categoryArticles',
            'opinions', 'editorials', 'videos', 'podcasts',
            'latest', 'mostRead', 'breakingNews', 'breakingArticles', 'trendingArticles', 'editorPicks',
            'liveUpdates', 'trendingVideos', 'navCategories', 'advertisements'
        ));
    }
}
