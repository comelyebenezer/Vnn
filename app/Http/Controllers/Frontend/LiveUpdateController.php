<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\LiveUpdate;

class LiveUpdateController extends Controller
{
    public function show($id)
    {
        $live = LiveUpdate::findOrFail($id);

        return view('frontend.live.show', compact('live'));
    }
}
