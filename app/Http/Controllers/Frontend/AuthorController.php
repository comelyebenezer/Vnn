<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;

class AuthorController extends Controller
{
    public function __invoke($id)
    {
        $author = User::with(['roles', 'author'])->findOrFail($id);

        $articles = Article::where('user_id', $author->id)
            ->where('status', 'published')
            ->latest('publication_date')
            ->paginate(12);

        return view('frontend.authors.show', compact('author', 'articles'));
    }
}
