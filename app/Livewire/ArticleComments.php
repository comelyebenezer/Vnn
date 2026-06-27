<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class ArticleComments extends Component
{
    public Article $article;

    public string $body = '';

    public string $guestName = '';

    public string $guestEmail = '';

    protected array $rules = [
        'body' => 'required|string|min:2|max:2000',
        'guestName' => 'nullable|string|max:255',
        'guestEmail' => 'nullable|email|max:255',
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
            'guest_name' => auth()->check() ? null : ($this->guestName ?: null),
            'guest_email' => auth()->check() ? null : ($this->guestEmail ?: null),
            'ip_address' => request()->ip(),
            'status' => 'pending',
        ]);

        $this->body = '';
        $this->guestName = '';
        $this->guestEmail = '';

        $this->dispatch('comment-submitted');
    }

    public function render()
    {
        return view('livewire.article-comments');
    }
}
