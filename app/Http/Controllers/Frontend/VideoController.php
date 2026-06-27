<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;

class VideoController extends Controller
{
    public function __invoke()
    {
        $videos = Article::where('status', 'published')
            ->where('type', 'video')
            ->with(['category', 'author'])
            ->latest('publication_date')
            ->paginate(12);

        return view('frontend.video.index', compact('videos'));
    }
}
