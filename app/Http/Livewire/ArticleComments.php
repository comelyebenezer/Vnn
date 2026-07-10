<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class ArticleComments extends Component
{
    public Article $article;

    public string $body = '';

    public string $guestName = '';

    public string $guestEmail = '';

    public string $guestWebsite = '';

    public bool $success = false;

    protected array $rules = [
        'body' => 'required|string|min:2|max:2000',
        'guestName' => 'required|string|max:255',
        'guestEmail' => 'required|email|max:255',
        'guestWebsite' => 'nullable|url|max:255',
    ];

    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function submit()
    {
        $this->validate();

        Comment::create([
            'article_id' => $this->article->id,
            'user_id' => auth()->id(),
            'body' => $this->body,
            'guest_name' => $this->guestName,
            'guest_email' => $this->guestEmail,
            'guest_website' => $this->guestWebsite ?: null,
            'ip_address' => request()->ip(),
            'status' => 'pending',
        ]);

        $this->body = '';
        $this->guestWebsite = '';
        $this->success = true;

        $this->dispatch('comment-submitted');
    }

    public function render()
    {
        return view('livewire.article-comments');
    }
}
