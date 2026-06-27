<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $articles = Article::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('excerpt', 'like', "%{$query}%");
            })
            ->select('id', 'title', 'slug', 'excerpt', 'featured_image', 'publication_date')
            ->latest('publication_date')
            ->limit(8)
            ->get();

        return response()->json($articles);
    }
}
