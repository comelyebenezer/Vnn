<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Illuminate\Support\Str;
use Livewire\Component;

class NewsletterSubscribe extends Component
{
    public string $email = '';

    public string $name = '';

    public bool $success = false;

    public string $message = '';

    public string $layout = 'horizontal';

    protected array $rules = [
        'email' => 'required|email|max:255|unique:subscribers,email',
        'name' => 'nullable|string|max:255',
    ];

    public function subscribe()
    {
        $this->validate();

        Subscriber::create([
            'email' => $this->email,
            'name' => $this->name ?: null,
            'unsubscribe_token' => Str::random(32),
            'status' => 'active',
            'is_verified' => false,
        ]);

        $this->success = true;
        $this->message = 'You have been subscribed successfully!';
        $this->email = '';
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.newsletter-subscribe');
    }
}
