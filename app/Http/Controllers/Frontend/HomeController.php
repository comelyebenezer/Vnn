<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\BreakingNews;
use App\Models\LiveUpdate;
use App\Models\Video;
use App\Models\Gallery;
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

        $galleryImages = Gallery::where('status', 'published')
            ->orderBy('sort_order')
            ->latest()
            ->take(8)
            ->get();

        $vnnListCategory = Category::where('slug', 'vnn-list')->where('status', 'active')->first();
        $vnnListArticles = $vnnListCategory
            ? Article::where('category_id', $vnnListCategory->id)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->take(5)
                ->get()
            : collect();

        $documentaryCategory = Category::where('slug', 'documentary')->where('status', 'active')->first();
        $documentaryArticles = $documentaryCategory
            ? Article::where('category_id', $documentaryCategory->id)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->take(2)
                ->get()
            : collect();

        $techStartupsCategory = Category::where('slug', 'tech-start-ups')->where('status', 'active')->first();
        $techStartupsArticles = $techStartupsCategory
            ? Article::where('category_id', $techStartupsCategory->id)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->take(3)
                ->get()
            : collect();

        $latestGadgetsCategory = Category::where('slug', 'latest-gadgets')->where('status', 'active')->first();
        $latestGadgetsArticles = $latestGadgetsCategory
            ? Article::where('category_id', $latestGadgetsCategory->id)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->take(3)
                ->get()
            : collect();

        $socialTrendsCategory = Category::where('slug', 'social-trends')->where('status', 'active')->first();
        $socialTrendsArticles = $socialTrendsCategory
            ? Article::where('category_id', $socialTrendsCategory->id)
                ->where('status', 'published')
                ->where('type', 'video')
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->take(2)
                ->get()
            : collect();

        $latestReleaseCategory = Category::where('slug', 'latest-release')->where('status', 'active')->first();
        $latestReleaseArticles = $latestReleaseCategory
            ? Article::where('category_id', $latestReleaseCategory->id)
                ->where('status', 'published')
                ->with(['category', 'author'])
                ->latest('publication_date')
                ->take(2)
                ->get()
            : collect();

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
            'liveUpdates', 'trendingVideos', 'navCategories', 'advertisements', 'galleryImages',
            'vnnListArticles', 'documentaryArticles', 'techStartupsArticles', 'latestGadgetsArticles',
            'socialTrendsArticles', 'latestReleaseArticles'
        ));
    }
}
