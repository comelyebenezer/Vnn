<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function __invoke()
    {
        $videos = Video::where('status', 'published')
            ->with(['category'])
            ->latest()
            ->paginate(12);

        return view('frontend.video.index', compact('videos'));
    }
}
