<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;

class PodcastController extends Controller
{
    public function __invoke()
    {
        $podcasts = Article::where('status', 'published')
            ->where('type', 'podcast')
            ->with(['category', 'author'])
            ->latest('publication_date')
            ->paginate(12);

        return view('frontend.podcast.index', compact('podcasts'));
    }
}
