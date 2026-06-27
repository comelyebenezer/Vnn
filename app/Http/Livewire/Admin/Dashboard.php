<?php

namespace App\Http\Livewire\Admin;

use App\Models\Article;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::where('status', 'published')->count();
        $pendingReview = Article::where('status', 'pending_review')->count();
        $totalViews = Article::sum('view_count');

        $recentArticles = Article::with(['author', 'category'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard.index', compact(
            'totalArticles', 'publishedArticles', 'pendingReview', 'totalViews', 'recentArticles'
        ))->layout('layouts.app');
    }
}
