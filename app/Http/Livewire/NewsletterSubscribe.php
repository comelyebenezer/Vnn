<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Illuminate\Support\Str;
use Livewire\Component;

class NewsletterSubscribe extends Component
{
    public string $email = '';

    public bool $success = false;

    public string $message = '';

    public string $layout = 'horizontal';

    protected array $rules = [
        'email' => 'required|email|max:255',
    ];

    public function subscribe()
    {
        $this->validate();

        $existing = Subscriber::where('email', $this->email)->first();

        if ($existing) {
            if ($existing->status === 'unsubscribed') {
                $existing->update(['status' => 'active']);
                $this->success = true;
                $this->message = 'Welcome back! You have been resubscribed.';
            } else {
                $this->success = true;
                $this->message = 'You are already subscribed!';
            }
        } else {
            Subscriber::create([
                'email' => $this->email,
                'unsubscribe_token' => Str::random(32),
                'status' => 'active',
                'is_verified' => true,
            ]);
            $this->success = true;
            $this->message = 'You have been subscribed successfully!';
        }

        $this->email = '';
    }

    public function render()
    {
        return view('livewire.newsletter-subscribe');
    }
}
