<?php

namespace App\Http\Livewire\Admin\Newsletter;

use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class NewsletterManager extends Component
{
    public $newsletterId;
    public $subject;
    public $content;
    public $status = 'draft';
    public $sent_at;
    public $total_recipients = 0;
    public $opened_count = 0;
    public $clicked_count = 0;

    public $editMode = false;

    protected function rules()
    {
        return [
            'subject' => 'required|min:2|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,sent,scheduled',
        ];
    }

    public function mount($newsletter = null)
    {
        if ($newsletter) {
            if (is_string($newsletter) || is_int($newsletter)) {
                $newsletter = Newsletter::findOrFail($newsletter);
            }

            $this->editMode = true;
            $this->newsletterId = $newsletter->id;
            $this->subject = $newsletter->subject;
            $this->content = $newsletter->content;
            $this->status = $newsletter->status;
            $this->sent_at = $newsletter->sent_at;
            $this->total_recipients = $newsletter->total_recipients;
            $this->opened_count = $newsletter->opened_count;
            $this->clicked_count = $newsletter->clicked_count;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'subject' => $this->subject,
            'content' => $this->content,
            'status' => $this->status,
        ];

        if ($this->editMode) {
            $newsletter = Newsletter::findOrFail($this->newsletterId);
            $wasAlreadySent = $newsletter->status === 'sent';
            $newsletter->update($data);

            if ($this->status === 'sent' && !$wasAlreadySent) {
                $this->sendNewsletter($newsletter);
            }

            session()->flash('message', 'Newsletter updated successfully.');
        } else {
            $newsletter = Newsletter::create($data);

            if ($this->status === 'sent') {
                $this->sendNewsletter($newsletter);
            }

            $this->reset();
            session()->flash('message', 'Newsletter created successfully.');
        }

        return redirect()->route('admin.newsletter.index');
    }

    protected function sendNewsletter(Newsletter $newsletter): void
    {
        $subscribers = Subscriber::where('status', 'active')->get();

        $count = 0;
        foreach ($subscribers as $subscriber) {
            if ($subscriber->unsubscribe_token) {
                try {
                    Mail::to($subscriber->email)->queue(new NewsletterMail($newsletter, $subscriber));
                    $count++;
                } catch (\Exception $e) {
                    \Log::error("Newsletter send failed for {$subscriber->email}: " . $e->getMessage());
                }
            }
        }

        $newsletter->update([
            'status' => 'sent',
            'sent_at' => now(),
            'total_recipients' => $count,
        ]);
    }

    public function render()
    {
        return view('admin.newsletter.form')->layout('layouts.app');
    }
}
