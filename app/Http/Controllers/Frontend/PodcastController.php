<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Podcast;

class PodcastController extends Controller
{
    public function __invoke()
    {
        $podcasts = Podcast::where('status', 'published')
            ->with(['category'])
            ->latest()
            ->paginate(12);

        return view('frontend.podcast.index', compact('podcasts'));
    }
}
